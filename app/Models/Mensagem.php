<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Mensagem extends Model
{
    protected $table = 'mensagem';
    protected $fillable = ['id_remetente', 'id_destinatario', 'texto', 'lido'];

    public function getHateoas()
    {
        return [
            "self" => URL::to('mensagens/' . $this->id),
            "mensagens" => URL::to('mensagens/'),
        ];
    }
    public function getallHateoas()
    {
        return [
            "self" => URL::to('mensagens/' . $this->id),
        ];
    }
}
