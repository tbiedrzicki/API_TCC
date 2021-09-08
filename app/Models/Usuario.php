<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $fillable = ['nome', 'email', 'numero', 'senha'];
    //   protected $hidden =['senha'];

    public function Area()
    {
        return $this->morphToMany(Area::class, 'id_usuario');
    }
    public function getHateoas()
    {
        return [
            "self" => URL::to('usuarios/' . $this->id),
            "usuarios" => URL::to('usuarios/'),
            "areas" => URL::to('usuarios/' . $this->id . '/areas'),
            "grupos" => URL::to('usuarios/' . $this->id . '/grupos'),
        ];
    }
    public function getallHateoas()
    {
        return [
            "self" => URL::to('usuarios/' . $this->id),
            "areas" => URL::to('usuarios/' . $this->id . '/areas'),
            "grupos" => URL::to('usuarios/' . $this->id . '/grupos'),
        ];
    }
}
