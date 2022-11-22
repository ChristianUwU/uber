<?php

namespace App\Http\Controllers;

use App\Events\BVehiculoCreateEvent;
use App\Events\BVehiculoDestroyEvent;
use App\Events\BVehiculoEditEvent;
use App\Models\Bitacora;
use App\Models\BitacoraVehiculo;
use App\Models\Conductor;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use function PHPUnit\Framework\isNull;

class VehiculoController extends Controller
{
    /**                                     //By Julico
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carros = Vehiculo::join('conductors as co', 'co.id', '=', 'vehiculos.id_conductor')
            ->join('clientes as c', 'c.id', '=', 'co.cliente_id')
            ->join('users as u', 'u.id', '=', 'c.user_id')
            ->select('vehiculos.*', 'u.nombre as propietario')->get();
        // dd($carros);
        return view('VistaVehiculos.index', compact('carros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $propietario = Conductor::join('clientes as c', 'c.id', '=', 'conductors.cliente_id')
            ->join('users as u', 'u.id', '=', 'c.user_id')
            ->select('conductors.*', 'u.nombre as propietario')->get();
        return view('VistaVehiculos.create', compact('propietario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {

        // dd($r);
        // $this->validate($r, [
        //     'placa' => 'required|string|max:255',
        //     'marca' => 'required|string|max:255',
        //     'modelo' => 'required|string|max:255',
        //     'anio' => 'required|date',
        //     'estado' => 'required|string|max:255',
        //     'id_conductor' => 'required|numeric',
        // ]);
            // dd($r->ip());
        $vehiculo = new Vehiculo();
        $vehiculo->placa = $r->placa;
        $vehiculo->marca = $r->marca;
        $vehiculo->modelo = $r->modelo;
        $vehiculo->anio = $r->anio;
        $vehiculo->estado =  $r->estado;
        $vehiculo->id_conductor =  $r->propietario;
        $vehiculo->save();
        $vehiculo->ip =  $r->ip();

        event(new BVehiculoCreateEvent($vehiculo));
        return redirect()->route('vehiculo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $propietarios = User::get();
        $carro = Vehiculo::join('conductors as co', 'co.id', '=', 'vehiculos.id_conductor')
            ->join('clientes as c', 'c.id', '=', 'co.cliente_id')
            ->join('users as u', 'u.id', '=', 'c.user_id')
            ->where('vehiculos.id', $id)
            ->select('vehiculos.*', 'u.nombre as propietario')->first();
        return view('VistaVehiculos.edit', compact('carro', 'propietarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, Vehiculo $vehiculo)
    {
        // dd($r);
        $vehiculo->id = $r->id;
        $vehiculo->placa = $r->placa;
        $vehiculo->marca = $r->marca;
        $vehiculo->modelo = $r->modelo;
        $vehiculo->anio = $r->anio;
        $vehiculo->estado =  $r->estado;
        $vehiculo->id_conductor =  $r->id_conductor;
        // $vehiculo->updated_at = date('Y-m-d h:m:s');
        $vehiculo->save();
        $vehiculo->ip =  $r->ip();
        event(new BVehiculoEditEvent($vehiculo));

        return redirect()->route('vehiculo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $Vehiculo, Request $r)
    {
        // dd($Vehiculo);
        $Vehiculo->ip =  $r->ip();
        event(new BVehiculoDestroyEvent($Vehiculo));
        $Vehiculo->delete();
        return redirect()->route('vehiculo.index');
    }

    public function bitacora(Vehiculo $vehiculo)
    {

        $bitacora = BitacoraVehiculo::get();

        $pdf = Pdf::loadView('VistaBitacoras.BitacoraVehiculo', ['bitacora' => $bitacora])
            ->setPaper('letter', 'portrait');

        return $pdf->stream('Lista de Vehiculos' . '.pdf', ['Attachment' => 'true']);
    }

    public function pdf(Vehiculo $vehiculo)
    {

        $cars = Vehiculo::join('conductors as co', 'co.id', '=', 'vehiculos.id_conductor')
        ->join('clientes as c', 'c.id', '=', 'co.cliente_id')
        ->join('users as u', 'u.id', '=', 'c.user_id')
        ->select('vehiculos.*', 'u.nombre as propietario')->get();

        $pdf = Pdf::loadView('VistaVehiculos.imprimir', ['cars' => $cars])
            ->setPaper('letter', 'portrait');

        return $pdf->stream('Lista de Vehiculos' . '.pdf', ['Attachment' => 'true']);
    }

    public function estado(Request $r, Vehiculo $vehiculo)
    {
        // dd($r);
        $vehiculo = Vehiculo::find($r->id);
        $vehiculo->placa = $r->placa;
        $vehiculo->marca = $r->marca;
        $vehiculo->modelo = $r->modelo;
        $vehiculo->anio = $r->anio;
        $vehiculo->estado =  $r->estado;
        $vehiculo->id_conductor =  $r->propietario;
        $vehiculo->save();

        return redirect()->route('vehiculo.index');
    }
}
