<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agencia', function (Blueprint $table) {
            $table->bigInteger('ID_Alcaldia')->unsigned()->after('Nombre');
            $table->foreign('ID_Alcaldia')->references('ID_Alcaldia')->on('alcaldia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agencia', function (Blueprint $table) {
            //
        });
    }
};
