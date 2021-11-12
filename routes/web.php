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

$router->group(['prefix'=>'api'],function() use ($router){
    //register
    $router->post('/register','AuthenticationController@register');
    // login
    $router->post('/login','AuthenticationController@login');
    // profile
    $router->get('profile','UserController@profile');
    // get single user
    $router->get('users\{id}','UserController@singleUser');
    // get user
    $router->get('users','UserController@allUser');

});

$router->POST('/test','TestCrudController@create');
$router->get('/test','TestCrudController@index');
$router->get('/test/{id}','TestCrudController@showDetail');
$router->put('/test/update/{id}','TestCrudController@update');
$router->delete('/test/delete/{id}','TestCrudController@delete');


