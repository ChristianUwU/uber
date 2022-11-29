<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }
    
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'foto' => ['image', 'mimes:jpg,jpeg,png,gif,bmp,svg'],
        ]);

        $fotoCliente = $request->file('foto')->store('public/cliente');

        // if ($imagen = $request->file('foto')) {
        //     $rutaGuardarImagen = 'cliente-fotos/';
        //     $fotoCliente = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
        //     $imagen->move($rutaGuardarImagen, $fotoCliente);   // Movemos la imagen a la carpeta
        // }

        $user = User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Crear tabla de cliente
        Cliente::create([
            'user_id' => $user->id,
            'foto' => $fotoCliente,
        ]);

        // Asignamos Rol
        $user->assignRole('cliente');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
