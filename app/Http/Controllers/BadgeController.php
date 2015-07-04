<?php

namespace App\Http\Controllers;

use App\Services\SlackBadgeService;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    /**
     * Generate the badge poser.
     *
     * @param    SlackBadgeService $badge
     * @param    Request           $request
     * @return   \Illuminate\Http\Response
     * @internal param SlackStatusService $slack
     * @internal param Poser $poser
     */
    public function generate(SlackBadgeService $badge, Request $request)
    {
        return $badge->generate($request->get('format', 'flat'));
    }
}
