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

$router->post('login', 'AuthController@login');
$router->post('register', 'AuthController@register');
$router->get('profile', 'AuthController@profile');

$router->get('products', 'ProductController@index');
$router->post('products', 'ProductController@store');
$router->put('products/{id}', 'ProductController@update');
$router->delete('products/{id}', 'ProductController@destroy');

$router->get('orders', 'OrderController@index');
$router->post('orders', 'OrderController@store');