<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class grupo extends Model
{    protected $table = 'grupo';
     protected $fillable = ['id_usuario','descrição','datas'];
}
