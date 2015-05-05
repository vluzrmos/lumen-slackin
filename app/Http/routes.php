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

$app->get('/', function () {
    return view('socketio');
});

$app->get('/message', function (){
    publish('channel', 'awesome-event', ["message" => 'Something awesome happened!']);

    return 'OK';
});

//
//use Vluzrmos\SlackApi\SlackApiFacade as SlackApi;
//use Illuminate\Support\Facades\Artisan;
//
//function slackRtm(){
//    return SlackApi::get('rtm.start');
//}
//
//function slackTotals($force = false){
//    /** @var Illuminate\Contracts\Cache\Factory $cache */
//    $cache = app('cache');
//
//    return $cache->get('slack.totals', ['active' => 0, 'total' => 0]);
//};
//
//
//$app->get('/', function() use ($app) {
//    $totals = slackTotals();
//
//    return view('slack.index', compact('totals'));
//});
//
//$app->get('/slackapi', function() use ($app) {
//    $slackRtm = slackRtm();
//
//    return $slackRtm;
//});
//
//$app->get('/socket', function() use ($app) {
//    return view('app');
//});
//
//$app->get('/message', function() use ($app) {
//    /** @var Pusher $pusher */
//    $pusher = app('pusher');
//
//    $pusher->trigger('local', 'MessageSent', ['message' => 'Its done! - at '.\Carbon\Carbon::now()]);
//
//    return 'ok';
//});
