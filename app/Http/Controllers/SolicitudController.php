<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data['solicituds'] = Solicitud::paginate(8);
        return view('solicitud.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('solicitud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente_id = auth()->user()->cliente->id;
        $this->validate($request,[
            //'cliente_id' => 'exists:clientes',
            'ci' => 'numeric'
        ]);

        $fileData_fA = '';

        if($request->hasFile('fotoAntecedente') and ($request->fotoAntecedente->extension() == 'png' or $request->fotoAntecedente->extension() == 'jpg' or $request->fotoAntecedente->extension() == 'bmp')){
            $fileData_fA = $request->file('fotoAntecedente')->store('uploads','public');
        }

        $fileData_fL = '';

        if($request->hasFile('fotoLicencia') and ($request->fotoLicencia->extension() == 'png' or $request->fotoLicencia->extension() == 'jpg' or $request->fotoLicencia->extension() == 'bmp')){
            $fileData_fL = $request->file('fotoLicencia')->store('uploads','public');
        }

        $fileData_fTIC = '';

        if($request->hasFile('fotoTIC') and ($request->fotoTIC->extension() == 'png' or $request->fotoTIC->extension() == 'jpg' or $request->fotoTIC->extension() == 'bmp')){
            $fileData_fTIC = $request->file('fotoTIC')->store('uploads','public');
        }

        $fileData_fPA = '';

        if($request->hasFile('fotoPapelesAuto') and ($request->fotoPapelesAuto->extension() == 'png' or $request->fotoPapelesAuto->extension() == 'jpg' or $request->fotoPapelesAuto->extension() == 'bmp')){
            $fileData_fPA = $request->file('fotoPapelesAuto')->store('uploads','public');
        }

        $fileData_CIAnverso = '';

        if($request->hasFile('CI_Anverso') and ($request->CI_Anverso->extension() == 'png' or $request->CI_Anverso->extension() == 'jpg' or $request->CI_Anverso->extension() == 'bmp')){
            $fileData_CIAnverso = $request->file('CI_Anverso')->store('uploads','public');
        }

        $fileData_CIReverso = '';

        if($request->hasFile('CI_Reverso') and ($request->CI_Reverso->extension() == 'png' or $request->CI_Reverso->extension() == 'jpg' or $request->CI_Reverso->extension() == 'bmp')){
            $fileData_CIReverso = $request->file('CI_Reverso')->store('uploads','public');
        }

        $fileData_foto = '';

        if($request->hasFile('foto') and ($request->foto->extension() == 'png' or $request->foto->extension() == 'jpg' or $request->foto->extension() == 'bmp')){
            $fileData_foto = $request->file('foto')->store('uploads','public');
        }

        Solicitud::create([
            'cliente_id' => $cliente_id,
            'ci' => $request->ci,
            'fotoAntecedente' => $fileData_fA,
            'fotoLicencia' => $fileData_fL,
            'fotoTIC' => $fileData_fTIC,
            'fotoPapelesAuto' => $fileData_fPA,
            'fotoCI_Anverso' => $fileData_CIAnverso,
            'fotoCI_Reverso' => $fileData_CIReverso,
            'foto' => $fileData_foto,
        ]);

        return redirect()->route('dashboard');

    }

    /**
     * Modifica el estado de la solicitud
     *
     * @param  \Illuminate\Http\Request  $request
     *          $id de la solicitud
     *          $idAdmi id del administrador que responde la solicitud
     * @return \Illuminate\Http\Response
     */
    public function responder(Request $request, $id, $idAdmi) {
        $solicitud = DB::table('solicituds')
                        ->select('estado', 'detalle', 'administrador_id')
                        ->where($id)
                        ->first();

        $request->validate([
            'estado' => '',
        ]);

        $solicitud->estado = $request->estado;
        $solicitud->detalle = $request->detalle;
        $solicitud->administrador_id = $idAdmi;

        // switch ($solicitud->estado) {
        //     case 'A':
        //         # code...
        //         break;

        //     case 'R':
        //         # code...
        //         break;

        //     case 'U':
        //         # code...
        //         break;
            
        //     default:
        //         # code...
        //         break;
        // }

        return redirect()->route('solicitud.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accepted($id)
    {
        $solicitud = Solicitud::find($id);
        Conductor::create([
            'cliente_id' => $solicitud->cliente_id,
            'ci' => $solicitud->ci,
            'CI_Anverso' => $solicitud->fotoCI_Anverso,
            'CI_Reverso' => $solicitud->fotoCI_Reverso,
            'fotoAntecedente' => $solicitud->fotoAntecedente,
            'fotoLicencia' => $solicitud->fotoLicencia,
            'fotoTIC' => $solicitud->fotoLicencia,
            'foto' => $solicitud->foto,
            'ocupado' => 0,
        ]);
        Solicitud::destroy($id);
        return redirect()->route('solicitud.index');
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
        Solicitud::destroy($id);
        return redirect()->route('solicitud.index');
    }
}
