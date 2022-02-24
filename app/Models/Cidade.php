<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $fillable = [
        'nome',
        'estado_id'
    ];

    public $timestamps = false;

    public static function listCidades($estadoId){
        return Cidade::select(
            'cidades.id',
            'cidades.nome',
        )
        ->where('cidades.estado_id', $estadoId)
        ->orderBy('nome', 'ASC')
        ->get();
    }

}
