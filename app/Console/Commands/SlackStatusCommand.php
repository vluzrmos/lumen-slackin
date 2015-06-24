<?php

namespace App\Console\Commands;

use App\Services\SlackStatusService;
use Illuminate\Console\Command;

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
        $this->info('Checking for new status...');

        $this->slack->refreshUsersStatus();

        $this->info('Done!');
    }
}
