<?php

namespace App\Console\Commands;

use App\Services\SlackService;
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
        $this->slack->refreshTeamInfo();
    }
}
