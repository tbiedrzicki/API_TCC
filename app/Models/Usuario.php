<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $fillable = ['nome', 'email', 'numero', 'senha', 'area', 'ajudar'];
}