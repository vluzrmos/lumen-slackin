<?php

namespace App\Services;

use Illuminate\Contracts\Cache\Factory as Cache;
use Illuminate\Contracts\Cache\Repository;
use Vluzrmos\SlackApi\Contracts\SlackUserAdmin;

class SlackTeamService
{
    /**
     * Key of totals cache.
     */
    const SLACK_TEAM_INFO_KEY = 'slack.info';

    /**
     * @var  Repository
     */
    protected $cache;

    /**
     * @var  SlackUserAdmin
     */
    protected $slack;

    /**
     * @var SlackChannelsService
     */
    protected $channels;

    public function __construct(Cache $cache, SlackUserAdmin $slack, SlackChannelsService $channels)
    {
        $this->cache = $cache;

        $this->slack = $slack;

        $this->channels = $channels;
    }

    /**
     * Invite a new member to slack team.
     *
     * @param string $email
     * @param string $username
     */
    public function inviteMember($email, $username = '')
    {
        $this->slack->invite(
            $email, [
                'first_name' => $username,
                'channels' => $this->channels->getConfigChannelsString()
            ]
        );
    }
}
