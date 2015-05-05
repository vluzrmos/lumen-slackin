<?php

namespace App\Console\Commands;

use Illuminate\Cache\CacheManager;
use Illuminate\Console\Command;
use Illuminate\Contracts\Cache\Factory as Cache;
use Vluzrmos\SlackApi\SlackApiFacade as SlackApi;
use Vluzrmos\Socketio\Broadcast;

class SlackStatusCommand extends Command{

    /**
     * Key of totals cache
     */
    const SLACK_TOTALS_KEY = 'slack.totals';

    /**
     * @var CacheManager
     */
    protected $cache;

    /**
     * Command Name
     * @var string
     */
    protected $name = "slack:status";

    /**
     * @var Broadcast
     */
    protected $broadcast;

    /**
     * @param Cache         $cache
     */
    public function __construct(Cache $cache, Broadcast $broadcast){
        parent::__construct();

        $this->cache = $cache;

        $this->broadcast = $broadcast;

    }

    /**
     *  Performs the event
     */
    public function fire(){
        $oldTotals = $this->cache->get(SELF::SLACK_TOTALS_KEY);

        $rtm = SlackApi::get('rtm.start');

        $totals = [
            'active' => 0,
            'total'  => 0
        ];

        foreach($rtm['users'] as $user){
            if($this->isRealUser($user)){
                $totals['total'] ++;

                if($this->isActiveUser($user)){
                    $totals['active'] ++;
                }
            }
        }

        $this->cache->forever(self::SLACK_TOTALS_KEY, $totals);

        if($oldTotals != $totals){
            $this->broadcast->publish('local', 'UsersActivity', $totals);
        }
    }

    /**
     * Tell whenever a user is active
     * @param $user
     * @return bool
     */
    protected function isActiveUser($user){
        return $user['presence'] == 'active';
    }

    /**
     * Check if a user is a real, and not a bot
     * @param $user
     * @return bool
     */
    protected function isRealUser($user){
        return (isset($user['is_bot']) and !$user['is_bot']) OR $user['id']!='USLACKBOT';
    }
}
