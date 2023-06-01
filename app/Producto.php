<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable =[
        'idcategoria','codigo','nombre','codigo_digemid','lote',
        'fecha_vencimiento','precio_venta','stock','presentacion',
        'principio','descripcion','condicion'
    ];
    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}
