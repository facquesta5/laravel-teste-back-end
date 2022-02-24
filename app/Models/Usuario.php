<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'endereco_id',
    ];
    public $timestamps = false;

    public function endereco(){
        return $this->belongsTo(Endereco::class);
    }

}
