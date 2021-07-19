<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario_area extends Model
{
    protected $table = 'usuarioArea';
    protected $fillable = ['id_usuario','id_area','ajuda'];
   
}
