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

$router->group(['middleware' => 'apicheck'], function () use ($router) {

    //rotas funções cadastro usuario
    $router->get('/usuarios', ['as' => 'usuarios.all', 'uses' => 'UsuarioController@all']);
    $router->get('/usuarios/{id}', ['as' => 'usuarios.get', 'uses' => 'UsuarioController@one']);
    $router->post('/usuarios', ['as' => 'usuarios.post', 'uses' => 'UsuarioController@store']);
    $router->put('/usuarios/{id}', ['as' => 'usuarios.put', 'uses' => 'UsuarioController@update']);
    $router->delete('/usuarios/{id}', ['as' => 'usuarios.delete', 'uses' => 'UsuarioController@destroy']);

    //rotas funções cadastro usuario na area
    $router->get('/usuarios/{id}/areas', ['as' => 'usuarioarea.all', 'uses' => 'UsuarioController@usuarioAreaGet']);
    $router->post('/usuarios/{id}/areas', ['as' => 'usuarioarea.post', 'uses' => 'UsuarioController@UsuarioAreaPost']);
    $router->delete('/usuarios/{id}/areas', ['as' => 'usuarioarea.delete', 'uses' => 'UsuarioController@UsuarioAreaDelete']);

    //rotas funções cadastro de area    
    $router->get('/areas', ['as' => 'areas.all', 'uses' => 'AreaController@all']);
    $router->get('/areas/{id}', ['as' => 'areas.get', 'uses' => 'AreaController@one']);
    $router->post('/areas', ['as' => 'areas.post', 'uses' => 'AreaController@store']);
    $router->put('/areas/{id}', ['as' => 'areas.put', 'uses' => 'AreaController@update']);
    $router->delete('/areas/{id}', ['as' => 'areas.delete', 'uses' => 'AreaController@destroy']);

    //rotas funções cadastro usuario no grupo
    $router->get('/usuarios/{id}/grupo', ['as' => 'usuariogrupo.all', 'uses' => 'UsuarioController@usuarioGrupoGet']);
    $router->post('/usuarios/{id}/grupo', ['as' => 'usuariogrupo.post', 'uses' => 'UsuarioController@UsuarioGrupoPost']);
    $router->delete('/usuarios/{id}/grupo', ['as' => 'usuariogrupo.delete', 'uses' => 'UsuarioController@UsuarioGrupoDelete']);

    //rotas funções cadastro de grupo    
    $router->get('/grupo', ['as' => 'grupo.get', 'uses' => 'GrupoController@all']);
    $router->get('/grupo/{id}', ['as' => 'grupo.get', 'uses' => 'GrupoController@one']);
    $router->post('/grupo', ['as' => 'grupo.post', 'uses' => 'GrupoController@store']);
    $router->put('/grupo/{id}', ['as' => 'grupo.put', 'uses' => 'grupoController@update']);
    $router->delete('/grupo/{id}', ['as' => 'grupo.delete', 'uses' => 'GrupoController@destroy']);

    //rotas funções cadastro materiais
    $router->get('/materiais', ['as' => 'materiais.all', 'uses' => 'MaterialController@all']);
    $router->get('/materiais/{id}', ['as' => 'materiais.get', 'uses' => 'MaterialController@one']);
    $router->post('/materiais', ['as' => 'materiais.post', 'uses' => 'MaterialController@store']);
    $router->put('/materiais/{id}', ['as' => 'materiais.put', 'uses' => 'MaterialController@update']);
    $router->delete('/materiais/{id}', ['as' => 'materiais.delete', 'uses' => 'MaterialController@destroy']);

    //rotas funções cadastro mensagem 
    $router->get('/mensagens', ['as' => 'mensagens.all', 'uses' => 'MensagemController@all']);
    $router->get('/mensagens/{id}', ['as' => 'mensagens.one', 'uses' => 'MensagemController@one']);
    $router->post('/mensagens', ['as' => 'mensagens.post', 'uses' => 'MensagemController@store']);
    $router->put('/mensagens/{id}', ['as' => 'mensagens.put', 'uses' => 'MensagemController@update']);

    $router->get('/usuarios/{id}/mensagensRem', ['as' => 'mensagens.get', 'uses' => 'UsuarioController@mensagemUserRemGet']);
    $router->get('/usuarios/{id}/mensagensDest', ['as' => 'mensagens.get', 'uses' => 'UsuarioController@mensagemUserDesGet']);
});

$router->post('/authenticate', ['as' => 'autentica.api', 'uses' => 'UsuarioAPIController@store']);
