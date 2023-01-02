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
        Schema::create('bitacora_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('user');                             //quien hizo
            $table->string('accion');                           //que hizo
            $table->date('fecha');                              //cuando hizo
            $table->time('hora');                               //a que hora hizo
            $table->string('ip');                               //ip del cliente/usuario
            $table->string('vehiculo_id');
            $table->string('placa');
            $table->string('marca');
            $table->string('modelo');
            $table->date('anio');
            $table->string('estado');
            $table->unsignedBigInteger('id_conductor');
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
        Schema::dropIfExists('bitacora_vehiculos');
    }
};
