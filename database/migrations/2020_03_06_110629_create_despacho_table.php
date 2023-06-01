<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDespachoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despacho', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idpedido')->unsigned();
            $table->foreign('idpedido')->references('id')->on('pedido');
            $table->integer('idusuario')->unsigned();
            $table->foreign('idusuario')->references('id')->on('users');
            $table->integer('idvehiculo')->unsigned();
            $table->foreign('idvehiculo')->references('id')->on('vehiculo');
            $table->string('estado',50);
            $table->string('descripcion',100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('despacho');
    }
}
