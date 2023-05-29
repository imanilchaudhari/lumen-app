<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('users', ['uses' => '\App\Http\Controllers\UsersController@index']);
    $router->get('users/{id}', ['uses' => '\App\Http\Controllers\UsersController@view']);
    $router->put('users/{id}', ['uses' => '\App\Http\Controllers\UsersController@update']);
});
