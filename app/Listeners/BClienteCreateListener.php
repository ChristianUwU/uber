<?php

namespace App\Listeners;

use App\Events\BClienteCreateEvent;
use App\Models\BitacoraCliente;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;


class BClienteCreateListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\BClienteCreateEvent  $event
     * @return void
     */
    public function handle(BClienteCreateEvent $event)
    {
        //aqui vamos a poner los datos que vamos a poblar en la tabla de la bitacora de clientes create
        $cliente = new BitacoraCliente();
        $cliente->user = Auth::user()->nombre;
        $cliente->accion = 'create';
        $cliente->fecha = now();
        $cliente->hora = now();
        $cliente->cliente_id = $event->bclientecreate->cliente_id;
        $cliente->fecha_nacimiento = $event->bclientecreate->fecha_nacimiento;
        $cliente->foto_cliente = $event->bclientecreate->foto_cliente;
        $cliente->user_id = $event->bclientecreate->user_id;
    }
}
