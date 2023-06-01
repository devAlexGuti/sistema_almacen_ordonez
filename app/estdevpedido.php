<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estdevpedido extends Model
{
    protected $table = 'estdevpedidos';
    protected $fillable = [
        'idpedido', 
        'estado'
    ];
    public $timestamps = false;
}
