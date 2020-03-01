<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    protected $fillable = ['id','titulo','prioridade', 'situacao','descricao','user_id']; // habilitar o preenchimento
    protected $guarded = []; // desabilitar o preenchimento
}
