<?php

namespace App\Listeners;
use App\Models\BitacoraVehiculo;
use App\Events\BVehiculoDestroyEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class BVehiculoDestroyListener
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
     * @param  \App\Events\BVehiculoDestroyEvent  $event
     * @return void
     */
    public function handle(BVehiculoDestroyEvent $event)
    {
        // dd($event);
        $vehiculo = new BitacoraVehiculo();
        $vehiculo->user = Auth::user()->nombre;
        $vehiculo->accion = 'destroy';
        $vehiculo->fecha = now();
        $vehiculo->hora = now();
        $vehiculo->vehiculo_id = $event->bvehiculodestroy->id;
        $vehiculo->ip = $event->bvehiculodestroy->ip;
        //desde aqui son los datos creados
        $vehiculo->placa = $event->bvehiculodestroy->placa;
        $vehiculo->marca = $event->bvehiculodestroy->marca;
        $vehiculo->modelo = $event->bvehiculodestroy->modelo;
        $vehiculo->anio = $event->bvehiculodestroy->anio;
        $vehiculo->estado = $event->bvehiculodestroy->estado;
        $vehiculo->id_conductor = $event->bvehiculodestroy->id_conductor;
        $vehiculo->save();
    }
}
