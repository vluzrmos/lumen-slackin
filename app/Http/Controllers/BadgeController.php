<?php

namespace App\Http\Controllers;


use App\Services\SlackService;
use Illuminate\Http\Request;
use Vluzrmos\BadgePoser\Contracts\Poser;

class BadgeController extends Controller
{
	/**
	 * Generate the badge poser
	 * @param SlackService $slack
	 * @param Poser        $poser
	 * @param Request      $request
	 * @return mixed
	 */
	public function generate(SlackService $slack, Poser $poser, Request $request){
		$totals = $slack->getCachedUsersStatus();

		app()->configure('slack-badge');

		$response = $poser->generate(config('slack-badge.slogan'), $totals['active']."/".$totals['total'], config('slack-badge.color'), $request->get('format', config('slack-badge.format', 'flat')));

		return $response;
	}
}
