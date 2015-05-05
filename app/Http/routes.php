<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Vluzrmos\SlackApi\SlackApiFacade as SlackApi;
use \App\Console\Commands\SlackStatusCommand as SlackStatus;

function slackRtm(){
    return SlackApi::get('rtm.start');
}

function slackTotals(){
    /** @var Illuminate\Contracts\Cache\Factory $cache */
    $cache = app('cache');

    return $cache->get(SlackStatus::SLACK_TOTALS_KEY, ['active' => 0, 'total' => 0]);
};


$app->get('/', function() use ($app) {
    $totals = slackTotals();

    return view('slack.index', compact('totals'));
});

