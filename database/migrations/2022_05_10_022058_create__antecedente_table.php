<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedente', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('ID_Antecendente');
            $table->date('Fecha_Antecendente')->nullable();
            $table->tinyInteger('Detenido'); // 1 = CON DETENIDO / 2 = SIN DETENIDO
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
        Schema::dropIfExists('antecedente');
    }
}
