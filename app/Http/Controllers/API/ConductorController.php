<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Conductor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ConductorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
                ->select('ci', 'foto', 'ocupado', 'CI_Anverso', 'CI_Reverso',
                        'fotoAntecedentes', 'fotoLicencia', 'fotoTic', 'cliente_id')
                ->where('deleted_at', null)  // Datos Activados
                ->orderBy('ci')
                ->paginate(15);

        return response($users, 200);    
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
            'ci' => ['numeric'],
            'foto' => ['image'],
            'CI_Anverso' => ['image'],
            'CI_Reverso' => ['image'],
            'fotoAntecedentes' => ['image'],
            'fotoLicencia' => ['image'],
            'fotoTIC' => ['image'],
        ]);

        $user = auth()->user();
        $foto = $request->file('foto')->store('public/conductor/Foto') ?? ''; 
        $ci_anverso = $request->file('CI_Anverso')->store('public/conductor/CI') ?? '';
        $ci_reverso = $request->file('CI_Reverso')->store('public/conductor/CI') ?? '';
        $foto_antecedentes = $request->file('fotoAntecedentes')->store('public/conductor/Antecedentes') ?? '';
        $foto_licencia = $request->file('fotoLicencia')->store('public/conductor/Licencia') ?? '';
        $foto_tic = $request->file('fotoTIC')->store('public/conductor/TIC') ?? '';
        
        $conductor = Conductor::Create([
            'cliente_id' => $user->cliente->id,
            'ci' => $request->ci,
            'foto' => $foto,
            'fotoAntecedente' => $foto_antecedentes,
            'fotoLicencia' => $foto_licencia,
            'fotoTIC' => $foto_tic,
            'CI_Anverso' => $ci_anverso,
            'CI_Reverso' => $ci_reverso,
            'ocupado' => false,
        ]);

        return response($conductor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conductor = Conductor::find($id);

        return response($conductor, 200);
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
        $conductor  = Conductor::Find($id);
        $cliente    = Cliente::Find($conductor->cliente_id);
        $user       = User::Find($cliente->user_id);

        if ($conductor != null && $cliente != null && $user != null) {
            return response('Error al eliminar conductor', 401);
        }

        $conductor->delete();
        $cliente->delete();
        $user->delete();

        return response('Conductor eliminado corectamente', 201);
    }
}
