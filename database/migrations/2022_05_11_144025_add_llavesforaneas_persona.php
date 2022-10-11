<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLlavesforaneasPersona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('persona', function (Blueprint $table) {
            $table->bigInteger('ID_Calidad')->unsigned();
            $table->foreign('ID_Calidad')->references('ID_Calidad')->on('calidad_juridica');

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
        Schema::table('persona', function (Blueprint $table) {
            //
        });
    }
}
