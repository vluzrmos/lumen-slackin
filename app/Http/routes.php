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
});

$app->get('/random', function() use ($app){
    Cache::forever(\App\Console\Commands\SlackStatusCommand::SLACK_TOTALS_KEY, ['total' => 1, 'active' => 1]);
    publish('local', 'UsersActivity', ['total' => 1, 'active' => 1]);

    return 'OK';
});

