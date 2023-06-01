<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedido';

    protected $fillable =[
        'idventa', 
        'idusuario',
        'num_pedido',
        'dir_enviar',
        'fecha_enviar',
        'hora_enviar',
        'descripcion',
        'estado'
    ];
}
