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

$router->group(['middleware' => 'apicheck'], function() use ($router){

    $router->get('/usuarios',['as'=> 'usuarios.all', 'uses' => 'UsuarioController@all']);
    $router->get('/usuarios/{id}',['as'=> 'usuarios.get', 'uses' => 'UsuarioController@one']);
    $router->post('/usuarios',['as'=> 'usuarios.post', 'uses' => 'UsuarioController@store']);
    $router->put('/usuarios/{id}', ['as' => 'usuarios.put', 'uses' => 'UsuarioController@update']);
    $router->delete('/usuarios/{id}', ['as' => 'usuarios.delete', 'uses' => 'UsuarioController@destroy']);
    
});


$router->post('/authenticate', ['as' => 'auntentica.api', 'uses' => 'UsuarioAPIController@store']);