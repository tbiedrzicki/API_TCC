<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class UsuarioGrupo extends Model
{
    protected $table = 'usuarioGrupo';
    protected $fillable = ['id_usuario','id_grupo'];
  
    public function getHateoas()
    {
        return [
            "self" => URL::to('usuarios/' . $this->id . '/grupos'),
            "usuarios" => URL::to('usuarios/' . $this->id),
        ];
    }
}
