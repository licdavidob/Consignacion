<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLlavesforaneasAntecedente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('antecedente', function (Blueprint $table) {
            $table->bigInteger('ID_Juzgado')->unsigned();
            $table->foreign('ID_Juzgado')->references('ID_Juzgado')->on('juzgado');

            $table->bigInteger('ID_Consignacion')->unsigned();
            $table->foreign('ID_Consignacion')->references('ID_Consignacion')->on('consignacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('antecedente', function (Blueprint $table) {
            //
        });
    }
}
