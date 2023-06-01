<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad_medida extends Model
{
    protected $table = 'unidad_medida';
    //protected $primaryKey = 'id';
    protected $fillable = ['nombre','prefijo','estado'];

    public function productos()
    {
        return $this->hasMany('App\Producto');
    }
}
