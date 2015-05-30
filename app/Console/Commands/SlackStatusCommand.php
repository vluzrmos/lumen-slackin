<?php

namespace App\Console\Commands;

use App\Services\SlackService;
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
     * @var SlackService
     */
    private $slack;

    /**
     * @param SlackService $slack
     */
    public function __construct(SlackService $slack)
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
