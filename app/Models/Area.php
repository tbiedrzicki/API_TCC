<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Area extends Model
{
    protected $table = 'area';
    protected $fillable = ['area'];

    public function getHateoas()
    {
        return [
            "self" => URL::to('areas/' . $this->id),
            "areas" => URL::to('areas/'),
        ];
    }
    public function getallHateoas()
    {
        return [
            "self" => URL::to('areas/' . $this->id),
        ];
    }
}
