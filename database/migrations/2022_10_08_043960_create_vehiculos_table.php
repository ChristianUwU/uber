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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('placa');
            $table->string('marca');
            $table->string('modelo');
            $table->string('anio');
            $table->string('estado');
            $table->string('foto_vehiculo');
            $table->string('papeles_vehiculo')->nullable();   // Importante registrar los papeles

            $table->foreignId('conductor_id', 'id')
                ->on('conductors')
                ->onDelete('cascade')
                ->onCascade('cascade');
            
            $table->timestamps();
            $table->softDeletes();

            // $table->unsignedBigInteger('id_conductor')->nullable();

            // $table->foreignId('id_conductor')
            // ->references('id')
            // ->on('conductores')
            // ->onDelete('Cascade')
            // ->onCascade('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
};
