<?php

namespace App\Console\Commands;

use App\Services\SlackStatusService;

class SlackStatusCommand extends Command
{
    /**
     * Command Name.
     *
     * @var string
     */
    protected $name = 'slack:status';

    /**
     * @var string
     */
    protected $description = "Get the total and active users on team";

    /**
     * @var SlackStatusService
     */
    private $slack;

    /**
     * @param SlackStatusService $slack
     */
    public function __construct(SlackStatusService $slack)
    {
        parent::__construct();

        $this->slack = $slack;
    }

    /**
     *  Performs the event.
     */
    public function fire()
    {
        $this->info(trans('slackin.updating_status'));

        $status = $this->slack->refreshUsersStatus();

        $this->infoStatusUser($status);

        $this->info(trans('slackin.command_done'));
    }

    /**
     * Show info message about status of users
     *
     * @param array $status
     */
    public function infoStatusUser(array $status)
    {
        $message = strip_tags(trans_choice('slackin.users_online', $status['active'], $status));

        $this->info($message);
    }
}
