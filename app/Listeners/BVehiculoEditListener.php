<?php

namespace App\Listeners;

use App\Models\BitacoraVehiculo;
use Illuminate\Support\Facades\Auth;
use App\Events\BVehiculoEditEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BVehiculoEditListener
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
     * @param  \App\Events\BVehiculoEditEvent  $event
     * @return void
     */
    public function handle(BVehiculoEditEvent $event)
    {
        // dd($event);
        $vehiculo = new BitacoraVehiculo();
        $vehiculo->user = Auth::user()->nombre;
        $vehiculo->accion = 'edit';
        $vehiculo->fecha = now();
        $vehiculo->hora = now();
        $vehiculo->vehiculo_id = $event->bvehiculoedit->id;
        $vehiculo->ip = $event->bvehiculoedit->ip;
        //desde aqui son los datos creados
        $vehiculo->placa = $event->bvehiculoedit->placa;
        $vehiculo->marca = $event->bvehiculoedit->marca;
        $vehiculo->modelo = $event->bvehiculoedit->modelo;
        $vehiculo->anio = $event->bvehiculoedit->anio;
        $vehiculo->estado = $event->bvehiculoedit->estado;
        $vehiculo->id_conductor = $event->bvehiculoedit->id_conductor;
        $vehiculo->save();
    }
}
