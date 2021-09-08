<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Material extends Model
{
    protected $table = 'material';
    protected $fillable = ['id_usuario', 'id_area', 'descrição', 'local_arquivo', 'datas'];

    public function getHateoas()
    {
        return [
            "self" => URL::to('material/' . $this->id),
            "material" => URL::to('materiais/'),
        ];
    }
    public function getallHateoas()
    {
        return [
            "self" => URL::to('materiais/' . $this->id),
        ];
    }
}
