<?php
/**
 * Created by PhpStorm.
 * User: vluzrmos
 * Date: 09/05/15
 * Time: 03:04
 */

namespace App\Http\Controllers;


use App\Console\Commands\SlackStatusCommand;
use App\Console\Commands\SlackTeamInfoCommand;
use App\Jobs\SlackInvitationJob;
use Illuminate\Contracts\Cache\Factory as Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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
        return view('slack.index', ['totals' => $this->getCachedUsersStatus(), 'team'=> $this->getCachedTeamInfo()]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function postInvite(Request $request){
        $this->validate($request, [
            'username' => 'required|min_words:2',
            'email'    => 'required|email'
        ]);

        $this->dispatch(new SlackInvitationJob(
            $request->get('email'),
            $request->get('username')
        ));

        return [
            'message' => trans('slackin.invited')
        ];
    }

    /**
     *
     * @return array
     */
    protected function getCachedUsersStatus(){
        $cached = $this->cache->get(SlackStatusCommand::SLACK_TOTALS_KEY);

        if(!$cached){
            Artisan::call('slack:status');
            $cached = $this->cache->get(SlackStatusCommand::SLACK_TOTALS_KEY);
        }

        return $cached;
    }

    protected function getCachedTeamInfo(){
        $cached = $this->cache->get(SlackTeamInfoCommand::SLACK_TEAM_INFO_KEY);

        if(!$cached){
            Artisan::call('slack:team');
            $cached = $this->cache->get(SlackTeamInfoCommand::SLACK_TEAM_INFO_KEY);
        }

        return $cached;
    }
}
