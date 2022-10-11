<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLlavesforaneasAliasPersona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alias_persona', function (Blueprint $table) {
            $table->bigInteger('ID_Persona')->unsigned();
            $table->foreign('ID_Persona')->references('ID_Persona')->on('persona');

            $table->bigInteger('ID_Alias')->unsigned();
            $table->foreign('ID_Alias')->references('ID_Alias')->on('alias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alias_persona', function (Blueprint $table) {
            //
        });
    }
}
