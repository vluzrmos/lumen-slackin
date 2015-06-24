<?php

namespace App\Console\Commands;

use App\Services\SlackStatusService;

class SlackTeamInfoCommand extends Command
{
    /**
     * Command Name.
     *
     * @var string
     */
    protected $name = 'slack:team';

    /**
     * @var string
     */
    protected $description = "Get info about the slack team";

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
        $this->info(trans('slackin.updating_team_info'));

        $info = $this->slack->refreshTeamInfo();

        $this->horizontalTable($info);

        $this->info(trans('slackin.command_done'));
    }
}
