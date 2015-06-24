<?php

namespace App\Console\Commands;

use App\Services\SlackStatusService;
use Illuminate\Console\Command;

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
        $this->info('Checking slack team info...');

        $this->slack->refreshTeamInfo();

        $this->info('Done!');
    }
}
