<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->dataTime('fecha');
            $table->string('descripcion',100);
            $table->foreignId('log_id')
                ->nullable()
                ->constrained('logs')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('archivo_id')
                ->nullable()
                ->constrained('archivos')
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
        Schema::dropIfExists('logs');
    }
}
