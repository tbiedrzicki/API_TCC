<?php

namespace App\Http\Middleware;

use App\Models\UsuarioAPI;
use Closure;

class APIUserControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    
        if($request->header('Authorization') == null) return response()->json(['error' => 'Unauthorized'], 401);
        $key = explode(" ", $request ->header('Authorization'));
        $usuarioAPI = UsuarioAPI::where('token', $key[1])->first();
        //dd($usuarioAPI);
        if($usuarioAPI == null) return response()->json(['error' => 'Não foi encontrado o token enviado'], 404);
        return $next($request);
    }
}