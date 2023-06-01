<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntregaPerfectaPreTest extends Model
{
    protected $table='entrega_perfecta_pretest';

    protected $fillable=[
        'item',
        'fecha_consulta',
        'ped_ep',
        'tot_pe',
        'entrega_perfecta_pretest'
    ];
}
