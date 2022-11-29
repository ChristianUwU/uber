<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);
        return view('usuario.show', ['user' => $usuario]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        return view('usuario.edit', ['usuario' => $usuario]);
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
        $request->validate([
            'nombre' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255'],
            'apellido' => ['string', 'max:255'],
            'telefono' => ['max:10'],
            'foto' => ['image', 'mimes:jpg,jpeg,png,gif,bmp,svg'],
        ]);
        
        $user = User::find($id);

        if ($password = $request->password) {  // Envio contraseña
            if (!Hash::check($password, $user->password)) {
                return response([
                    'massage' => 'Contraseña Incorecta'
                ], 401);
            }
            
            $user->password = Hash::make($request->new_password);
        }

        $cliente = $user->cliente;
        $fotoCliente = $cliente->foto;

        
        // Verificar si existe imagen
        if ($imagen = $request->file('foto')) {
            $rutaGuardarImagen = 'cliente-fotos/';
            $imageUser = Str::uuid() . "." . $imagen->getClientOriginalExtension();
            if ($fotoCliente != null) { // Eliminar foto anterior
                dd('public/cliente-fotos/' . $fotoCliente);
                Storage::delete('cliente-fotos/' . $fotoCliente);
            }
            $imagen->move($rutaGuardarImagen, $imageUser);
        }

        if ($request->nombre != null) 
            $user->nombre = $request['nombre'];
        if ($request->apellido != null) 
            $user->apellido = $request['apellido'];    
        if ($request->telefono != null) 
            $user->telefono = $request['telefono'];
        if ($request->email != null) 
            $user->email = $request['email']; 
            
        $user->update();

        $cliente->foto = $imageUser ?? '';
        $cliente->update();
        
        return redirect()->route('usuario.show', ['usuario' => $user]);
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

    // public function exportExcel()
    // {
    //     return Excel::download(new UsersExport,'repo-user.xlsx');
    // }
}
