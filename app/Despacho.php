<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Despacho extends Model
{
    protected $table = 'despacho';
    protected $fillable = ['idpedido','idusuario','idvehiculo','estado','descripcion'];
}
