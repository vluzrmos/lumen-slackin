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
     * @param Cache $cache Default cache provider
     * @param Broadcast $broadcast default socket provider
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
        $this->info("Retrieving previews cached status...");

        $oldTotals = $this->getCachedUsersStatus();

        $this->info("Checking for new status...");
        $totals = $this->getUsersStatus();

        $this->info("Caching the results...");
        $this->setCachedUsersStatus($totals);

        if($oldTotals != $totals){
            $this->info("Broadcasting changed status...");
            $this->broadcast->publish('local', 'UsersActivity', $totals);
        }
        else{
            $this->info("Status not changed!");
        }

        $this->info("Done!");
    }

    /**
     * Get the previews cached users status
     * @return array
     */
    public function getCachedUsersStatus(){
        return $this->cache->get(SELF::SLACK_TOTALS_KEY, $this->getEmptyStatus());
    }

    /**
     * Set the new users status
     * @param array $totals
     * @return mixed
     */
    public function setCachedUsersStatus($totals = []){
        $this->cache->forever(self::SLACK_TOTALS_KEY, empty($totals)?$this->getEmptyStatus():$totals);
    }

    /**
     * Return the total users and logged users
     * @return array
     */
    protected function getUsersStatus(){
        $rtm = SlackApi::get('rtm.start');

        $totals = $this->getEmptyStatus();

        foreach($rtm['users'] as $user){
            if($this->isRealUser($user)){
                $totals['total'] ++;

                if($this->isActiveUser($user)){
                    $totals['active'] ++;
                }
            }
        }

        return $totals;
    }

    /**
     * Get an empty array of user status
     * @return array
     */
    public function getEmptyStatus(){
        return [
            'active' => 0,
            'total' => 0
        ];
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
