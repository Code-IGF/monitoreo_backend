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
            $table->foreignId('configuracion_id')
                ->nullable()
                ->constrained('configuracions')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('equipos_id')
                ->nullable()
                ->constrained('equipos')
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
