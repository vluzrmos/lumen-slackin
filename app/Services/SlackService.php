<?php

namespace App\Services;

use Illuminate\Contracts\Cache\Factory as Cache;
use Illuminate\Contracts\Cache\Repository;
use Vluzrmos\SlackApi\Contracts\SlackApi;

class SlackService
{
    /**
     * Key of totals cache.
     */
    const SLACK_TEAM_INFO_KEY = 'slack.info';
    /**
     * Key of totals cache.
     */
    const SLACK_TOTALS_KEY = 'slack.totals';

    /**
     * Config index.
     *
     * @var string
     */
    protected $configSpace = 'services.slack';

    /** @var  Repository */
    protected $cache;

    /** @var  SlackApi */
    protected $slack;

    public function __construct(Cache $cache, SlackApi $slack)
    {
        $this->cache = $cache;

        $this->slack = $slack;
    }

    /**
     * Invite a new member to slack team.
     *
     * @param string $email
     * @param string $username
     */
    public function inviteMember($email, $username = '')
    {
        $this->slack->post('users.admin.invite', [
                'email' => $email,
                'first_name' => $username,
                'set_active' => true,
                'channels' => $this->getConfigChannelsString(),
                '_attempts' => 1,
        ]);
    }

    /**
     * Get Configuration for a key with a default (if that doesn't exists).
     *
     * @param $key
     * @param null $default
     *
     * @return mixed
     */
    public function getConfig($key, $default = null)
    {
        return config($this->configSpace.'.'.$key, $default);
    }

    /**
     * Get array of channels.
     *
     * @return array
     */
    public function getApiChannels()
    {
        $jsonObject = $this->slack->get('channels.list');

        $channels = array_filter($jsonObject['channels'], function ($channel) {
            return !$channel['is_archived'];
        });

        return $channels;
    }

    /**
     * Get channels by name or ID.
     *
     * @param array $ids
     *
     * @return array
     */
    public function getApiChannelsById($ids = [])
    {
        if (is_string($ids)) {
            $ids = preg_split('/, ?/', $ids);
        }

        $ids = (array) $ids;

        return array_filter($this->getApiChannels(), function ($channel) use (&$ids) {
            return (in_array($channel['id'], $ids) or in_array($channel['name'], $ids));
        });
    }

    /**
     * Get api configurated channels and parse to string to be used in a api request.
     *
     * @return string
     */
    public function getConfigChannelsString()
    {
        $channels = $this->getConfig('channels', '');

        if (in_array($channels, ['all', '*'])) {
            $apiChannels = $this->getApiChannels();
        } else {
            $apiChannels = $this->getApiChannelsById($channels);
        }

        return $this->parseChannelsToString($apiChannels);
    }

    /**
     * Parse channels IDs to string to be used in a api request.
     *
     * @param array $channels
     *
     * @return string
     */
    public function parseChannelsToString($channels = [])
    {
        $channels = array_map(function ($channel) {
            return $channel['id'];
        }, $channels);

        return implode(',', $channels);
    }

    /**
     * Return the previus cached users status or generate a new one.
     *
     * @return array
     */
    public function getCachedUsersStatus()
    {
        $cached = $this->cache->get(self::SLACK_TOTALS_KEY);

        if (!$cached) {
            $cached = $this->refreshUsersStatus();
        }

        return $cached;
    }

    /**
     * @return array
     */
    public function getCachedTeamInfo()
    {
        /** @var array|null $cached */
        $cached = $this->cache->get(self::SLACK_TEAM_INFO_KEY);

        if (!$cached) {
            $cached = $this->refreshTeamInfo();
        }

        return $cached;
    }

    /**
     * Refresh Team info by Api data.
     *
     * @return array|null
     */
    public function refreshTeamInfo()
    {
        $info = $this->slack->get('team.info');

        $this->cache->forever(self::SLACK_TEAM_INFO_KEY, $info['team']);

        return $info['team'];
    }

    /**
     * Return the total users and logged users.
     *
     * @return array
     */
    public function refreshUsersStatus()
    {
        $rtm = $this->slack->get('rtm.start');

        $totals = $this->getEmptyStatus();

        foreach ($rtm['users'] as $user) {
            if ($this->isRealUser($user)) {
                $totals['total']++;

                if ($this->isActiveUser($user)) {
                    $totals['active']++;
                }
            }
        }

        $this->cache->forever(self::SLACK_TOTALS_KEY, $totals);

        return $totals;
    }

    /**
     * Get an empty array of user status.
     *
     * @return array
     */
    public function getEmptyStatus()
    {
        return [
            'active' => 0,
            'total' => 0,
        ];
    }

    /**
     * Tell whenever a user is active.
     *
     * @param $user
     *
     * @return bool
     */
    protected function isActiveUser($user)
    {
        return $user['presence'] == 'active';
    }

    /**
     * Check if a user is a real, and not a bot.
     *
     * @param $user
     *
     * @return bool
     */
    protected function isRealUser($user)
    {
        return (isset($user['is_bot']) and !$user['is_bot']) and $user['deleted'] == false and $user['id'] != 'USLACKBOT';
    }
}
