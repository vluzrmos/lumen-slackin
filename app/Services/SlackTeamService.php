<?php

namespace App\Services;

use Illuminate\Contracts\Cache\Factory as Cache;
use Illuminate\Contracts\Cache\Repository;
use Vluzrmos\SlackApi\Contracts\SlackApi;

class SlackTeamService
{
	/**
	 * Key of totals cache.
	 */
	const SLACK_TEAM_INFO_KEY = 'slack.info';

	/** @var  Repository */
	protected $cache;

	/** @var  SlackApi */
	protected $slack;

	/** @var SlackChannelsService  */
	protected $channels;

	public function __construct(Cache $cache, SlackApi $slack, SlackChannelsService $channels)
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
		$this->slack->post('users.admin.invite', [
			'email' => $email,
			'first_name' => $username,
			'set_active' => true,
			'channels' => $this->channels->getConfigChannelsString(),
			'_attempts' => 1,
		]);
	}


}
