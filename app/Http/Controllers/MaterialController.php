<?php

namespace App\Http\Controllers;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{

    public function __construct()
    {
        $this->middleware('apicheck');
    }

    public function all()
    {
        $material=Material::all();

        return response()->json($material, 200);
        
    }

    //retorno de um objeto
    public function one($id = null) 
    {
        if($id == null) return response() -> json(['error' => 'ID é obrigatorio'], 400);
        $material = Material::find($id);
        if($material == null) return response() -> json(['error' => 'entidade não encontrada'], 404);
        return response()->json($material, 200);
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
        if(!$request->json()->has('local_arquivo')) return response() -> json(['error' => 'entrada invalida, campo obrigatorio não enviado'], 400);
        $dados = $request ->json()-> all();
        $material = Material::create($dados);
        return response() -> json($material, 201);
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
        $material = Material::find($id);
        if($material == null) return response()->json(['error' => 'entidade não encontrada'], 404);
        $dados = $request->json()->all();
        if($request->json()->has('descrição')) $material->descrição = $dados['descrição'];
        if($request->json()->has('local_arquivo')) $material->local_arquivo= $dados['local_arquivo'];
        if($material->save()) return response()->json($material, 200);
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

        $material = Material::find($id);
        if($material == null) return response()->json(['error' => 'registro não encontrado'], 404);

        if($material->delete()) return response()->json(['registro foi removido'], 200);
    }
}
