<?php

namespace App\Http\Controllers\Api;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Conductor;
use App\Models\User;
use App\Models\Vehiculo;

class SolicitudController extends Controller
{
    // Rutas RUTA_CONDUCTOR
    const CONDUCTOR = 'public/conductor';
    
    // Vehiculos
    const VEHICULO = 'public/vehiculo';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ci' => ['required', 'numeric'],
            'foto' => ['required', 'image'],
            'fotoCI_Anverso' => ['required', 'image'],
            'fotoCI_Reverso' => ['required', 'image'],
            'fotoAntecedentes' => ['required', 'image'],
            'fotoLicencia' => ['required', 'image'],
            'fotoTIC' => ['required', 'image'],
            // Vehiculo
            'placa' => ['required', 'string'],
            'anio' => ['required'],
            'marca' => ['required'],
            'modelo' => ['required'],
            'fotoVehiculo' => ['required', 'image'],
            'fotoPapelesAuto' => ['required', 'image'],
        ]);

        $conductor = SolicitudController::CONDUCTOR;
        $vehiculo = SolicitudController::VEHICULO;

        $user = auth()->user();
        $foto = $request->file('foto')->store($conductor.'/foto') ?? ''; 
        $ci_anverso = $request->file('fotoCI_Anverso')->store($conductor.'/ci/anverso') ?? '';
        $ci_reverso = $request->file('fotoCI_Reverso')->store($conductor.'/ci/reverso') ?? '';
        $foto_antecedentes = $request->file('fotoAntecedentes')->store($conductor.'/antecedentes') ?? '';
        $foto_licencia = $request->file('fotoLicencia')->store($conductor.'/licencia') ?? '';
        $foto_tic = $request->file('fotoTIC')->store($conductor.'/tic') ?? '';
        
        // Image de vehiculos
        $foto_papeles = $request->file('fotoPapelesAuto')->store($vehiculo.'/papeles') ?? '';
        $foto_vehiculo = $request->file('fotoVehiculo')->store($vehiculo.'/foto') ?? '';

        Solicitud::Create([
            'cliente_id' => $user->cliente->id,
            'ci' => $request->ci,
            'foto' => $foto,
            'fotoCI_Anverso' => $ci_anverso,
            'fotoCI_Reverso' => $ci_reverso,
            'fotoAntecedente' => $foto_antecedentes,
            'fotoLicencia' => $foto_licencia,
            'fotoTIC' => $foto_tic,
            'fotoPapelesAuto' => $foto_papeles,
            'fotoVehiculo' => $foto_vehiculo,
            'placa' => $request->placa,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'anio' => $request->anio,
            'estado' => 'E',  // Estado en Espera
        ]);

        $message = 'Solicitud enviada corectamente';

        return response($message, 201);
    }

    /**
     * Modifica el estado de la solicitud
     *
     * @param  \Illuminate\Http\Request  $request
     *          $id de la solicitud
     *          $idAdmi id del administrador que responde la solicitud
     * @return \Illuminate\Http\Response
     */
    public function responder(Request $request, $id) {
        $solicitud = Solicitud::find($id);

        $solicitud->estado = $request->estado;
        $solicitud->detalle = $request->detalle;
        $solicitud->administrador_id = auth()->user()->id;
        $solicitud->save();

        switch ($solicitud->estado) {
            case 'A':
                // Solicitud Aceptada, registrar conductor
                $conductor = Conductor::create([
                    'ci' => $solicitud->ci,
                    'foto' => $solicitud->foto,
                    'ocupado' => false,
                    'CI_Anverso' => $solicitud->fotoCI_Anverso,
                    'CI_Reverso' => $solicitud->fotoCI_Reverso,
                    'fotoAntecedente' => $solicitud->fotoAntecedente,
                    'fotoLicencia' => $solicitud->fotoLicencia,
                    'fotoTIC' => $solicitud->fotoTIC,
                    'cliente_id' => $solicitud->cliente_id,
                ]);

                Vehiculo::create([
                    'placa' => $solicitud->placa,
                    'marca' => $solicitud->marca,
                    'modelo' => $solicitud->modelo,
                    'anio' => $solicitud->anio,
                    'estado' => $solicitud->estado,
                    'foto_vehiculo' => $solicitud->fotoVehiculo,
                    'papeles_vehiculo' => $solicitud->fotoPapelesAuto,
                    'conductor_id' => $conductor->id ?? 0,
                ]);

                // 
                $cliente = Cliente::find($solicitud->cliente_id);
                $user = User::find($cliente->user_id);

                // Se convierte en conductor
                $user->is_driver = true;
                $user->save();

                return response('Conductor Aceptado', 201);

                break;

            case 'R':
                # code...
                break;

            case 'U':
                # code...
                break;
            
            default:
                # code...
                break;
        }

        return response("Solicitud en espera", 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitud = Solicitud::where($id)->first();

        return response($solicitud, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sendRequest($user_id)
    {
        // Buscamos el cliente
        $cliente = DB::table('clientes')
                    ->select('id')
                    ->where('user_id', $user_id)
                    ->first();
                    
        if($cliente){
            $solicitud = DB::table('solicituds')
            ->where('cliente_id', $cliente->id)
            ->get();

            // Obtengo la ultima solicitud
            
            if(count($solicitud) > 0){
                $solicitud = $solicitud[count($solicitud)-1];
                // Existe Solicitud
                return response([
                    'sendRequest' => true, 
                    'estado' => $solicitud->estado,
                ], 201);
            }
        }

        return response(204);
    }
}
