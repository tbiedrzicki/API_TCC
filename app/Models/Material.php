<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'material';
    protected $fillable = ['id_usuario', 'id_area', 'descricao', 'local_arquivo', 'datas'];    
}
