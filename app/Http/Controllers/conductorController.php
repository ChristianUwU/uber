<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Conductor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ConductorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conductors = Conductor::all();
        return view('conductor.index', ['conductors' => $conductors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('conductor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|numeric|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required','confirmed',Password::defaults()],
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

        $user = User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'apellido' => $request->apellido,
            'telefono' => '+591'.$request->telefono,
            'password' => Hash::make($request->password)
        ])->assignRole('conductor');

        $cliente = Cliente::create([
            'user_id' => $user->id,
        ]);

        Conductor::create([
            'cliente_id' => $cliente->id,
            'ci' => $request->ci,
            'ocupado' => 0,
            'fotoAntecedente' => $fileData_fA,
            'fotoLicencia' => $fileData_fL,
            'fotoTIC' => $fileData_fTIC,
        ]);

        return redirect()->route('conductor.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conductor = Conductor::find($id);
        return view('conductor.edit',compact('conductor'));
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
        $conductor = Conductor::find($id);
        $user = $conductor->cliente->user;

        $this->validate($request,[
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|numeric',
            // 'email' => 'required|string|email|max:255',
        ]);

        // if($request->email != $conductor->user->email){
        //     $this->validate($request,[
        //         'email' => 'unique:users',
        //     ]);
        // }

        if($request->telefono != $conductor->cliente->user->telefono){
            $this->validate($request,[
                'telefono' => 'unique:users',
            ]);
        }

        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->telefono = $request->telefono;
        $conductor->ci = $request->ci;

        $user->save();
        $conductor->save();

        return redirect()->route('conductor.edit',$conductor);
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
}
