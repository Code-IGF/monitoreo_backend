<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sala_trabajos', function (Blueprint $table) {
            $table->id();   
            $table->foreignId('equipos_id')
                ->nullable()
                ->constrained('equipos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->time('hora_entrada');
            $table->time('hora_salida');
            $table->time('intervalo_conexion');
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
        Schema::dropIfExists('sala_trabajo');
    }
}
