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
            $table->integer('ci');
            // $table->string('estado');
            $table->string('fotoAntecedente');
            $table->string('fotoLicencia');
            $table->string('fotoTIC');
            $table->string('fotoPapelesAuto');
            $table->string('fotoCI_Anverso');
            $table->string('fotoCI_Reverso');
            $table->string('foto');
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
