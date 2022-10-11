<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLlavesforaneasConsignacionDelito extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consignacion_delito', function (Blueprint $table) {
            $table->bigInteger('ID_Delito')->unsigned();
            $table->foreign('ID_Delito')->references('ID_Delito')->on('delito');

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
        Schema::table('consignacion_delito', function (Blueprint $table) {
            //
        });
    }
}
