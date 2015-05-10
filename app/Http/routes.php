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

$app->group(['namespace' => 'App\Http\Controllers'], function() use($app){
    $app->get('/', 'IndexController@getIndex');
    $app->post('/invite', 'IndexController@postInvite');
});

$app->get('/random', function() use ($app){
    $totals = ['total' => $app->request->input('total', 1), 'active' => $app->request->input('active', 1)];

    Cache::forever(\App\Console\Commands\SlackStatusCommand::SLACK_TOTALS_KEY, $totals);

    publish('local', 'UsersActivity', $totals);

    return 'OK';
});



