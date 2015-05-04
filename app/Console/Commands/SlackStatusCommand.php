<?php

namespace App\Console\Commands;

use Illuminate\Cache\CacheManager;
use Illuminate\Console\Command;
use Illuminate\Contracts\Cache\Factory as Cache;
use Vinkla\Pusher\PusherManager;
use Illuminate\Support\Facades\Log;
use Vluzrmos\SlackApi\SlackApiFacade as SlackApi;

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
     * @var PusherManager
     */
    protected $pusher;

    /**
     * @param Cache         $cache
     * @param PusherManager $pusher
     */
    public function __construct(Cache $cache, PusherManager $pusher){
        parent::__construct();

        $this->cache = $cache;

        $this->pusher = $pusher;

    }

    /**
     *
     */
    public function fire(){
        $oldTotals = $this->cache->get(SELF::SLACK_TOTALS_KEY);

        $rtm = SlackApi::get('rtm.start');

        $users = $rtm['users'];

        $activeUsers = array_filter($rtm['users'], function($user){
            return $user['presence'] == 'active' && !$user['is_bot'] && $user['id']!='USLACKBOT';
        });

        $totals = [
            'active' => count($activeUsers),
            'total'  => count($users)
        ];

        $this->cache->forever(self::SLACK_TOTALS_KEY, $totals);


        if($oldTotals != $totals){
            if(env('app.debug')){
                Log::info("Users online: ".$totals['active']);
                Log::info("Total users: ".$totals['total']);
            }

            $this->pusher->trigger('local', 'UsersActivity', $totals);
        }
    }
}
