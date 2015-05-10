<?php

namespace App\Console\Commands;

use Illuminate\Cache\CacheManager;
use Illuminate\Console\Command;
use Illuminate\Contracts\Cache\Factory as Cache;
use Vluzrmos\SlackApi\SlackApiFacade as SlackApi;
use Vluzrmos\Socketio\Contracts\Broadcast;

class SlackTeamInfoCommand extends Command{

    /**
     * Key of totals cache
     */
    const SLACK_TEAM_INFO_KEY = 'slack.info';

    /**
     * @var CacheManager
     */
    protected $cache;

    /**
     * Command Name
     * @var string
     */
    protected $name = "slack:team";

    /**
     * @var Broadcast
     */
    protected $broadcast;

    /**
     * @param Cache $cache Default cache provider
     */
    public function __construct(Cache $cache){
        parent::__construct();

        $this->cache = $cache;
    }

    /**
     *  Performs the event
     */
    public function fire(){
        $info = SlackApi::get('team.info');

        $this->cache->forever(self::SLACK_TEAM_INFO_KEY, $info['team']);
    }

}
