<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $table = 'mensagem';
    protected $fillable = ['ide_remetente', 'id_destinatario', 'texto', 'lido', 'datas'];
}
