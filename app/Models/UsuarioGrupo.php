<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioGrupo extends Model
{
    protected $table = 'usuarioGrupo';
    protected $fillable = ['id_usuario','id_grupo'];
}
