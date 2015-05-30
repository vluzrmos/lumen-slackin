<?php

namespace App\Services;

use Illuminate\Contracts\Cache\Factory as Cache;
use Illuminate\Contracts\Cache\Repository;
use Vluzrmos\SlackApi\Contracts\SlackApi;

class SlackStatusService
{
    /**
     * Key of totals cache.
     */
    const SLACK_TEAM_INFO_KEY = 'slack.info';
    /**
     * Key of totals cache.
     */
    const SLACK_TOTALS_KEY = 'slack.totals';

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
     * Return the previus cached users status or generate a new one.
     *
     * @return array
     */
    public function getUsersStatus()
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
    public function getTeamInfo()
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
    protected function getEmptyStatus()
    {
        return [
            'active' => 0,
            'total'  => 0,
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
        return $this->isNotBot($user) and $this->isNotDeletedUser($user);
    }

	/**
	 * Check if the user is not a bot or Slackbot
	 * @param $user
	 * @return bool
	 */
	protected function isNotBot($user)
	{
		return (isset($user['is_bot']) and !$user['is_bot']) and $user['id'] != 'USLACKBOT';
	}

	/**
	 * Check if the user is not a deleted user
	 * @param $user
	 * @return bool
	 */
	protected function isNotDeletedUser($user)
	{
		return $user['deleted'] == false;
	}

}

