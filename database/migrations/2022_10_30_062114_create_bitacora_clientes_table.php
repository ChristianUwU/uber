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
        Schema::create('bitacora_clientes', function (Blueprint $table) {
            $table->id();
            $table->string('user');                             //quien hizo
            $table->string('accion');                           //que hizo
            $table->date('fecha');                              //cuando hizo
            $table->time('hora');                               //a que hora hizo
            $table->unsignedBigInteger('cliente_id');           //datos de la tabla/modelo (que datos toco xD)
            $table->string('fecha_nacimiento')->nullable();
            $table->string('foto_cliente')->nullable();
            $table->unsignedBigInteger('user_id');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bitacora_clientes');
    }
};
