<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntregaPerfectaPretestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrega_perfecta_pretest', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item')->unique();
            $table->string('fecha_consulta', 50);
            $table->integer('ped_ep');
            $table->integer('tot_pe');
            $table->decimal('entrega_perfecta_pretest', 11, 2);
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
        Schema::dropIfExists('entrega_perfecta_pretest');
    }
}
