<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class grupo extends Model
{    protected $table = 'grupo';
     protected $fillable = ['id_usuario_propietario','descrição','datas'];
     
     public function getHateoas()
     {
         return [
             "self" => URL::to('grupo/' . $this->id),
             "grupo" => URL::to('grupo/'),
         ];
     }
     public function getallHateoas()
     {
         return [
             "self" => URL::to('grupo/' . $this->id),
         ];
     }
}

