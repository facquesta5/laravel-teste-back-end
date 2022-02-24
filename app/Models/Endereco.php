<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'estado_id',
        'cidade_id',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cep'
    ];

    public $timestamps = false;

    public function cidade(){
        return $this->hasOne(Cidade::class);
    }

    public function estado(){
        return $this->hasOne(Estado::class);
    }
}
