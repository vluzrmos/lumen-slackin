<?php

namespace App\Console\Commands;

use App\Services\SlackService;
use Illuminate\Console\Command;
use Illuminate\Support\Debug\Dumper;

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
	 * @var Dumper
	 */
	private $dumper;

	/**
	 * @param SlackService $slack
	 * @param Dumper       $dumper
	 */
    public function __construct(SlackService $slack, Dumper $dumper)
    {
        parent::__construct();

        $this->slack = $slack;
		$this->dumper = $dumper;
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
