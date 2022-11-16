<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipoUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipo_usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_equipo')
                ->nullable()
                ->constrained('equipos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('id_usuario')
                ->nullable()
                ->constrained('users')
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
        Schema::dropIfExists('equipo_usuarios');
    }
}
