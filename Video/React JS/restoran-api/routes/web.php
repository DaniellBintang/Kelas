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

$router->post('/api/login', ['uses' => 'LoginController@login']);

$router->post('/api/register', ['uses' => 'LoginController@register']);

$router->get('/api/user', ['uses' => 'LoginController@index']);

$router->put('/api/user/{id}', ['uses' => 'LoginController@updateStatus']);


$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {
    //  kategori
    $router->get('/kategori', ['uses' => 'KategoriController@index']);
    $router->post('/kategori', ['uses' => 'KategoriController@create']);
    $router->get('/kategori/{id}', ['uses' => 'KategoriController@show']);
    $router->delete('/kategori/{id}', ['uses' => 'KategoriController@destroy']);
    $router->put('/kategori/{id}', ['uses' => 'KategoriController@update']);

    //  pelanggan
    $router->get('/pelanggan', ['uses' => 'PelangganController@index']);
    $router->get('/pelanggan/{id}', ['uses' => 'PelangganController@show']);
    $router->delete('/pelanggan/{id}', ['uses' => 'PelangganController@destroy']);
    $router->put('/pelanggan/{id}', ['uses' => 'PelangganController@update']);
    $router->post('/pelanggan', 'PelangganController@store');

    //  menu
    $router->post('/menu', ['uses' => 'MenuController@create']);
    $router->get('/menu', ['uses' => 'MenuController@index']);
    $router->delete('/menu/{id}', ['uses' => 'MenuController@destroy']);
    $router->get('/menu/{id}', ['uses' => 'MenuController@show']);
    $router->put('/menu/{id}', ['uses' => 'MenuController@update']);

    //  order
    $router->get('/order', ['uses' => 'OrderController@index']);
    $router->put('/order/{id}', ['uses' => 'OrderController@update']);
    $router->get('/order/{tgl_awal}/{tgl_akhir}', ['uses' => 'OrderController@show']);

    // detail
    $router->get('/detail/{tgl_awal}/{tgl_akhir}', ['uses' => 'DetailController@show']);
    $router->delete('/order/{idorder}', ['uses' => 'OrderController@destroy']);
    $router->get('/detail', ['uses' => 'DetailController@index']);

    //user
});
// ...existing code...
