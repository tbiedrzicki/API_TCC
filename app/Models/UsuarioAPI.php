<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioAPI extends Model
{
    protected $table = 'usuario_api';
    protected $fillable = ['email', 'senha', 'token'];
}
