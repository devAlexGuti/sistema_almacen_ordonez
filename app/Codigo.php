<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codigo extends Model
{
    protected $table = 'codigo';
    protected $fillable = ['idpedido','numcodigo','condicion'];

}
