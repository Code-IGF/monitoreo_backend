<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre', 25);
            $table->string('descripcion', 100)->nullable();
            $table->unsignedInteger('area_id');
            $table->unsignedInteger('supervisor')->nullable();
            
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('supervisor')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipos');
    }
}
