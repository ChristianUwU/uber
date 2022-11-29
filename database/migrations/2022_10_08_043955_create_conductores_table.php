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
        Schema::create('conductores', function (Blueprint $table) {
            $table->id();
            $table->string('ci');
            $table->string('foto')->nullable();
            $table->boolean('ocupado');
            $table->string('CI_Anverso')->nullable();
            $table->string('CI_Reverso')->nullable();
            $table->string('fotoAntecedente')->nullable();
            $table->string('fotoLicencia')->nullable();
            $table->string('fotoTIC')->nullable();
            $table->foreignId('cliente_id', 'id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conductores');
    }
};
