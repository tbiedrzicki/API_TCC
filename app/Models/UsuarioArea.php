<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class UsuarioArea extends Model
{
    protected $table = 'usuarioarea';
    protected $fillable = ['id_usuario', 'id_area', 'ajuda'];

    public function getHateoas()
    {
        return [
            "self" => URL::to('usuarios/' . $this->id_usuario . '/areas'),
            "usuarios" => URL::to('usuarios/' . $this->id_usuario),
        ];
    }
}
