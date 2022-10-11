<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLlavesforaneasConsignacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consignacion', function (Blueprint $table) {
            $table->bigInteger('ID_Agencia')->unsigned();
            $table->foreign('ID_Agencia')->references('ID_Agencia')->on('agencia');

            $table->bigInteger('ID_Juzgado')->unsigned();
            $table->foreign('ID_Juzgado')->references('ID_Juzgado')->on('juzgado');

            $table->bigInteger('ID_Reclusorio')->unsigned();
            $table->foreign('ID_Reclusorio')->references('ID_Reclusorio')->on('reclusorio');

            $table->bigInteger('ID_Averiguacion')->unsigned();
            $table->foreign('ID_Averiguacion')->references('ID_Averiguacion')->on('averiguacion_previa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consignacion', function (Blueprint $table) {
            //
        });
    }
}
