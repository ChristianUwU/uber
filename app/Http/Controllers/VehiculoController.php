<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
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
        $carros = Vehiculo::join('conductors as co','co.id','=','vehiculos.id_conductor')
        ->join('clientes as c','c.id','=','co.cliente_id')
        ->join('users as u','u.id','=','c.user_id')
        ->select('vehiculos.*','u.nombre as propietario')->get();
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
        $propietario = Conductor::join('clientes as c','c.id','=','conductors.cliente_id')
        ->join('users as u','u.id','=','c.user_id')
        ->select('conductors.*','u.nombre as propietario')->get();
        return view('VistaVehiculos.create',compact('propietario'));
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
        $this->validate($r, [
            'placa' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'anio' => 'required|date',
            'estado' => 'required|string|max:255',
        ]);
        if(isNull($r->propietario)){
            $vehiculo = new Vehiculo();
            $vehiculo->placa = $r->placa;
            $vehiculo->marca = $r->marca;
            $vehiculo->modelo = $r->modelo;
            $vehiculo->año = $r->anio;
            $vehiculo->estado =  $r->estado;
        }else{
            $vehiculo = new Vehiculo();
            $vehiculo->placa = $r->placa;
            $vehiculo->marca = $r->marca;
            $vehiculo->modelo = $r->modelo;
            $vehiculo->año = $r->anio;
            $vehiculo->estado =  $r->estado;
            $vehiculo->id_conductor =  $r->propietario;
        }
        $vehiculo->save();

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
        $carro = Vehiculo::where('id', $id)->first();
        return view('VistaVehiculos.edit', compact('carro'));
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
        $vehiculo->id = $r->id;
        if(isNull($r->propietario)){
            $vehiculo->placa = $r->placa;
            $vehiculo->marca = $r->marca;
            $vehiculo->modelo = $r->modelo;
            $vehiculo->año = $r->anio;
            $vehiculo->estado =  $r->estado;
        }else{
            $vehiculo->placa = $r->placa;
            $vehiculo->marca = $r->marca;
            $vehiculo->modelo = $r->modelo;
            $vehiculo->año = $r->anio;
            $vehiculo->estado =  $r->estado;
            $vehiculo->id_conductor =  $r->propietario;
        }
        $vehiculo->save();

        return redirect()->route('vehiculo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $Vehiculo)
    {
        // dd($Vehiculo);
        $Vehiculo->delete();
        return redirect()->route('vehiculo.index');
    }

    public function pdf(Vehiculo $vehiculo)
    {
        $cars = Vehiculo::get();
        $pdf = Pdf::loadView('VistaVehiculos.imprimir',['cars' => $cars])
            ->setPaper('letter', 'portrait');
        return $pdf->stream('Lista de Vehiculos' . '.pdf', ['Attachment' => 'true']);
    }
}