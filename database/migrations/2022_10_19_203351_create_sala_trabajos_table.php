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
        Schema::create('sala_trabajo', function (Blueprint $table) {
            $table->id('id_sala');
            $table->foreignId("configuracion_id")
                    ->constrained("configuracions")
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            $table->foreignId("equipo_id")
                ->constrained("equipos")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
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
