<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntregaTiempoPretestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrega_tiempo_pretest', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item')->unique();
            $table->string('fecha_consulta', 50);
            $table->integer('ped_et');
            $table->integer('tot_pe');
            $table->decimal('entrega_tiempo_pretest', 11, 2);
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
        Schema::dropIfExists('entrega_tiempo_pretest');
    }
}
