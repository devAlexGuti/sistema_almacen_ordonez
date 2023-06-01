<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntregasTiempoPreTest extends Model
{
    protected $table='entrega_tiempo_pretest';

    protected $fillable=[
        'item',
        'fecha_consulta',
        'ped_et',
        'tot_pe',
        'entrega_tiempo_pretest'
    ];
}
