<?php

namespace App\Http\Controllers;

use App\Models\UsuarioAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioAPIController extends Controller
{
    public function store(Request $request)
    {
        if(!$request->isJson()) return response() -> json(['error' => 'os dados devem ser enviados no formato JSON'], 415);
         if(!$request->json()->has('email') || !$request->json()->has('email')) {
         return response()->json(['error' => 'campos email e senha são obrigatórios'], 400);
     }
     $dados = $request->json()->all();
     $usuarioAPI=new UsuarioAPI();
     $usuarioAPI->email = $dados['email'];
     $usuarioAPI->senha = sha1($dados['senha']);
     $usuarioAPI->token = Hash::make($dados['senha']);
     if($usuarioAPI->save()){
         return response()->json(['token' => $usuarioAPI->token], 201);
     }
     return response()->json(['error'=>'algum problema na API'], 500);
 }
}
