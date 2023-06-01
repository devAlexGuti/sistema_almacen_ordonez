<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodigoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idpedido')->unsigned();
            $table->foreign('idpedido')->references('id')->on('pedido')->onDelete('cascade')->onUpdate('cascade');
            $table->string('numcodigo', 100);
            $table->boolean('condicion')->default(0);
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
        Schema::dropIfExists('codigo');
    }
}
