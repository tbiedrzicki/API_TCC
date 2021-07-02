<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('apicheck');
    }

    public function all()
    {
        $usuario =Usuario::all();

        return response()->json($usuario, 200);
        
    }

    //retorno de um objeto
    public function one($id = null) 
    {
        if($id == null) return response() -> json(['error' => 'ID é obrigatorio'], 400);
        $usuario = Usuario::find($id);
        if($usuario == null) return response() -> json(['error' => 'entidade não encontrada'], 404);
        return response()->json($usuario, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->isJson()) return response() -> json(['error' => 'dados devem ser enviados em formato JSON'], 415);
       // dd($request) -> json() -> all();
        if(!$request->json()->has('nome')) return response() -> json(['error' => 'entrada invalida, campo obrigatorio não enviado'], 400);
        $dados = $request ->json()-> all();
        $usuario = Usuario::create($dados);
        return response() -> json($usuario, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id == null) return response()->json(['error' => 'id na URL é obrigatória'], 400);
        $usuario = Usuario::find($id);
        if($usuario == null) return response()->json(['error' => 'entidade não encontrada'], 404);
        $dados = $request->json()->all();
        if($request->json()->has('nome')) $usuario->nome = $dados['nome'];
        if($request->json()->has('email')) $usuario->email= $dados['email'];
        if($request->json()->has('numero')) $usuario->numero= $dados['numero'];
        if($request->json()->has('senha')) $usuario->senha= $dados['senha'];
        if($request->json()->has('area')) $usuario->area= $dados['area'];
        if($request->json()->has('ajudar')) $usuario->ajudar= $dados['ajudar'];
        if($usuario->save()) return response()->json($usuario, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        if($id == null) return response()->json(['error' => 'id na URL é obrigatória'], 400);

        $usuario = Usuario::find($id);
        if($usuario == null) return response()->json(['error' => 'registro não encontrado'], 404);

        if($usuario->delete()) return response()->json(['registro foi removido'], 200);
    }
}
