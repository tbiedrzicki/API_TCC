<?php

namespace App\Http\Controllers;

use App\Models\Mensagem;
use Illuminate\Http\Request;

class MensagemController extends Controller
{
    public function __construct()
    {
        $this->middleware('apicheck');
    }

    public function all()
    {
        $mensagem = Mensagem::all();
        $response = $mensagem->toArray();
        $i = 0;
        while ($i < count($response)) {
            $response[$i]['links'] = $mensagem[$i]->getallHateoas();
            $i++;
        }
        return response()->json($response, 200);
    }
    public function one($id = null)
    {
        if ($id == null) return response()->json(['error' => 'ID é obrigatorio'], 400);
        $mensagem = Mensagem::find($id);
        if ($mensagem == null) return response()->json(['error' => 'entidade não encontrada'], 404);
        $response = $mensagem->toArray();
        $response['links'] = $mensagem->getHateoas();
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
        if (!$request->isJson()) return response()->json(['error' => 'dados devem ser enviados em formato JSON'], 415);

        if (!$request->json()->has('id_destinatario')) return response()->json(['error' => 'entrada invalida, campo obrigatorio não enviado'], 400);
        $dados = $request->json()->all();
        $mensagem = Mensagem::create($dados);
        $response = $mensagem->toArray();
        $response['links'] = $mensagem->getHateoas();
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

    public function update(Request $request, $id)
    {
        if ($id == null) return response()->json(['error' => 'id na URL é obrigatória'], 400);
        $mensagem = Mensagem::find($id);
        if ($mensagem == null) return response()->json(['error' => 'entidade não encontrada'], 404);
        $dados = $request->json()->all();
        if ($request->json()->has('lido')) $mensagem->lido = $dados['lido'];
        if ($mensagem->save())
            $response = $mensagem->toArray();
        $response['links'] = $mensagem->getHateoas();
        return response()->json($response, 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
