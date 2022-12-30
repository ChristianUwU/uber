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
        Schema::create('solicituds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id', 'id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('administrador_id', 'id')->nullable()->on('administrador')->onDelete('cascade')->onUpdate('cascade');
            
            // Datos del conductor
            $table->string('ci');
            $table->string('foto');   // Foto Conductor
            $table->string('fotoCI_Anverso');
            $table->string('fotoCI_Reverso');
            $table->string('fotoAntecedente');
            $table->string('fotoLicencia');
            $table->string('fotoTIC');
            
            // Datos del Vehiculo
            $table->string('fotoPapelesAuto');
            $table->string('placa');
            $table->string('marca');
            $table->string('modelo');
            $table->string('anio');
            $table->string('fotoVehiculo')->nullable();  
            
            $table->char('estado');    // Estado de la solicitud E (Espera), R(Rechazado) y A(Aceptado)
            $table->text('detalle')->nullable();
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
        Schema::dropIfExists('solicituds');
    }
};
