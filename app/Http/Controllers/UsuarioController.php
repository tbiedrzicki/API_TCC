<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\UsuarioArea;
use App\Models\Area;
use App\Models\grupo;
use App\Models\Mensagem;
use App\Models\UsuarioGrupo;
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
        $response = $usuario->toArray();
        $i = 0;
        while ($i < count($response)) {
            $response[$i]['links'] = $usuario[$i]->getallHateoas();
            $i++;
        }
       return response()->json($response, 200);
        
    }

    //retorno de um objeto
    public function one($id = null) 
    {
        if($id == null) return response() -> json(['error' => 'ID é obrigatorio'], 400);
        $usuario = Usuario::find($id);
        if($usuario == null) return response() -> json(['error' => 'entidade não encontrada'], 404);
        $response = $usuario->toArray();
         $response['links'] = $usuario->getHateoas();
         return response()->json($response, 200);
    
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
        if(!$request->json()->has('nome')) return response() -> json(['error' => 'entrada invalida, campo obrigatorio não enviado'], 400);
        $dados = $request ->json()-> all();
        $senha = $request ->json() -> has('senha');
        $dados['senha'] = md5($senha);
        $usuario = Usuario::create($dados);
        $response = $usuario->toArray();
        $response['links'] = $usuario->getHateoas();
        return response()->json($response, 201);
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
        if($request->json()->has('senha')) $usuario->senha= md5($dados['senha']);
        if($usuario->save()) 
        $response = $usuario->toArray();
        $response['links'] = $usuario->getHateoas();
       return response()->json($response, 201);
        //return response()->json($usuario, 200);
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

 
    public function usuarioAreaGet($id = null)
    {
        if($id == null) return response()->json(['error' => 'id na URL é obrigatória'], 400);

        $dados = Usuarioarea::where('id_usuario', $id) -> get();
        $response = $dados->toArray();
        $response['links'] = $dados->getHateoas();
        return response()->json($response, 200);
        // return response()->json($dados, 200);
    }
    

    public function usuarioAreaPost(Request $request, $id = null)
    {
        if($id == null) return response()->json(['error' => 'id na URL é obrigatória'], 400);
     
        if(!$request->isJson()) return response()->json(['error' => 'os dados devem ser enviados no formato JSON'], 415);
    
        if(!$request->json()->has('ajuda') || !$request->json()->has('id_area')){ return response()->json(['error' => 'campos obrigatórios não submetidos'], 400);}
      
        $idArea = $request['id_area'];
        if(!$request->json()->has('id_area') == Area::find($idArea) )
        {
            return response()->json(['error' => 'Area não cadastrada'], 400);
        }
/*
        if($request->json()->has('id_area') == UsuarioArea::where('id_area', $idArea || 'id_usuario', $id))
        {
            return response()->json(['error' => 'Area já cadastrada para usuario'], 400);
        }
    */
        $usuario = Usuario::find($id);
        $dados=$request->json()->all();
        $dados['id_usuario'] = $usuario->id;
        $usuarioArea = UsuarioArea::create($dados);
        $response = $usuarioArea->toArray();
        $response['links'] = $usuarioArea->getHateoas();
        return response()->json($response, 201);
        //return response()->json($usuarioArea, 201);
    } 

    public function usuarioAreaDelete(Request $request, $id = null)
    {
        if($id == null) return response()->json(['error' => 'id na URL é obrigatória'], 400);

        $idArea = $request['id_area'];
       
        if( UsuarioArea::where('id_area', $idArea)->delete())
        {
            return response()->json(['registro foi removido'], 200);
        }
        else
        {
            return response()->json(['error' => 'Area não cadastrada para o usuario'], 400);
        }
       
    
    }
    public function usuarioGrupoGet($id = null)
    {
    if($id == null) return response()->json(['error' => 'id na URL é obrigatória'], 400);
   $dados = UsuarioGrupo::where('id_usuario', $id) -> get();
    $response = UsuarioGrupo::find($id);
    //$response = $dados->toArray();
    $response['links'] = $response->getHateoas();
    $dados = $response;
   //return response()->json($response, 200);
    return response()->json($dados, 200);
    }

    public function usuarioGrupoPost(Request $request, $id = null)
    {
    if($id == null) return response()->json(['error' => 'id na URL é obrigatória'], 400);
 
    if(!$request->isJson()) return response()->json(['error' => 'os dados devem ser enviados no formato JSON'], 415);

    if( !$request->json()->has('id_grupo')){ return response()->json(['error' => 'campos obrigatórios não submetidos'], 400);}
  
    $idGrupo = $request['id_grupo'];
    if(!$request->json()->has('id_grupo') == grupo::find($idGrupo) )
    {
        return response()->json(['error' => 'Grupo não cadastrado'], 400);
    }
    /*
    if($request->json()->has('id_grupo') == UsuarioGrupo::where('id_grupo', $idGrupo ))
    {
        return response()->json(['error' => 'grupo já cadastrado para usuario'], 400);
    }
*/
    $usuario = Usuario::find($id);
    $dados=$request->json()->all();
    $dados['id_usuario'] = $usuario->id;
    $usuarioGrupo = UsuarioGrupo::create($dados);
   $response = $usuarioGrupo->toArray();
  $response['links'] = $usuarioGrupo->getHateoas();
  return response()->json($response, 201);
    // return response()->json($usuarioGrupo, 201);
} 
public function usuarioGrupoDelete(Request $request, $id = null)
{
    if($id == null) return response()->json(['error' => 'id na URL é obrigatória'], 400);
    $idGrupo = $request['id_grupo'];
   
    if( UsuarioGrupo::where('id_grupo', $idGrupo)->delete())
    {
        return response()->json(['registro foi removido'], 200);
    }
    else
    {
        return response()->json(['error' => 'Grupo não cadastrado para o usuario'], 400);
    }
   
}
public function mensagemUserGet($id = null)
 {
    if($id == null) return response()->json(['error' => 'id na URL é obrigatória'], 400);
    $dados = Mensagem::where('id_remetente', $id) -> get();
    $response = Mensagem::find($dados);
    $response['links'] = $response->getHateoas();
    $dados = $response;
    return response()->json($dados, 200);
     }
}
