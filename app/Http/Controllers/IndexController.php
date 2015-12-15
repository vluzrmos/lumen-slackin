<?php

namespace App\Http\Controllers;

use App\Jobs\SlackInvitationJob;
use App\Services\SlackStatusService;
use Illuminate\Contracts\Cache\Factory as Cache;
use Illuminate\Http\Request;

/**
 * Class IndexController
 * @package App\Http\Controllers
 */
class IndexController extends Controller
{
    /**
     * @var \Illuminate\Cache\Repository
     */
    protected $cache;

    /**
     * @var SlackStatusService
     */
    protected $slack;

    /**
     * @param Cache              $cache
     * @param SlackStatusService $slack
     */
    public function __construct(Cache $cache, SlackStatusService $slack)
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
            'team' => $this->slack->getTeamInfo(),
        ];

        if (env('SLACK_STATUS_ENABLED', true)) {
            $data['totals'] = $this->slack->getUsersStatus();
        }

        return view('slack.index', $data);
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function postInvite(Request $request)
    {
        $this->validate(
            $request,
            [
                'username' => 'required|min_words:2',
                'email' => 'required|email',
            ]
        );

        $this->dispatch(
            new SlackInvitationJob(
                $request->get('email'),
                $request->get('username')
            )
        );

        return [
            'message' => trans('slackin.invited'),
        ];
    }
}
