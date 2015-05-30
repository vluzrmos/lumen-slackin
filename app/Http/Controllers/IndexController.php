<?php

/**
 * Created by PhpStorm.
 * User: vluzrmos
 * Date: 09/05/15
 * Time: 03:04.
 */
namespace App\Http\Controllers;

use App\Jobs\SlackInvitationJob;
use App\Services\SlackService;
use Illuminate\Contracts\Cache\Factory as Cache;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * @var \Illuminate\Cache\Repository
     */
    protected $cache;

    /** @var SlackService */
    protected $slack;

    /**
     * @param Cache        $cache
     * @param SlackService $slack
     */
    public function __construct(Cache $cache, SlackService $slack)
    {
        $this->cache = $cache;
        $this->slack = $slack;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $data = [
            'totals' => $this->slack->getCachedUsersStatus(),
            'team' => $this->slack->getCachedTeamInfo(),
        ];

        return view('slack.index', $data);
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function postInvite(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min_words:2',
            'email' => 'required|email',
        ]);

        $this->dispatch(new SlackInvitationJob(
            $request->get('email'),
            $request->get('username')
        ));

        return [
            'message' => trans('slackin.invited'),
        ];
    }
}
