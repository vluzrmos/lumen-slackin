<?php
/**
 * Created by PhpStorm.
 * User: vluzrmos
 * Date: 09/05/15
 * Time: 03:04
 */

namespace App\Http\Controllers;


use App\Console\Commands\SlackStatusCommand;
use Illuminate\Contracts\Cache\Factory as Cache;

class IndexController extends Controller{

    /**
     * @var \Illuminate\Cache\Repository
     */
    protected $cache;

    /**
     * @param Cache $cache
     */
    public function __construct(Cache $cache){
        $this->cache = $cache;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getIndex(){
        return view('slack.index', ['totals' => $this->getCachedUsersStatus()]);
    }

    /**
     *
     * @return array
     */
    protected function getCachedUsersStatus(){
        return $this->cache->get(SlackStatusCommand::SLACK_TOTALS_KEY, ['active' => 0, 'total' => 0]);
    }
}
