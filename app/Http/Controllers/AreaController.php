<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{

    public function __construct()
    {
        $this->middleware('apicheck');
    }

    public function all()
    {
        $area =Area::all();

        return response()->json($area, 200);
        
    }

    //retorno de um objeto
    public function one($id = null) 
    {
        if($id == null) return response() -> json(['error' => 'ID é obrigatorio'], 400);
        $area = Area::find($id);
        if($area == null) return response() -> json(['error' => 'entidade não encontrada'], 404);
        return response()->json($area, 200);
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
        if(!$request->json()->has('area')) return response() -> json(['error' => 'entrada invalida, campo obrigatorio não enviado'], 400);
        $dados = $request ->json()-> all();
        $area = Area::create($dados);
        return response() -> json($area, 201);
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
        $area = Area::find($id);
        if($area == null) return response()->json(['error' => 'entidade não encontrada'], 404);
        $dados = $request->json()->all();
        if($request->json()->has('area')) $area->nome = $dados['area'];
        if($area->save()) return response()->json($area, 200);
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

        $area = Area::find($id);
        if($area == null) return response()->json(['error' => 'registro não encontrado'], 404);

        if($area->delete()) return response()->json(['registro foi removido'], 200);
    }
}
