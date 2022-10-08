<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException; //para enviar mensajes de error
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; //para encriptar contrasenas
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Empleado;
use App\Models\Proveedor;

class AuthController extends Controller
{
    public function login()
    {
       //  dd('llegue !!1');

        return view('VistasAuth.login');
    }

    public function loginStore(Request $r)
    {
        //del request solo sacame correo y contrasena
        $credenciales = $r->validate([
            'correo_electronico' => ['required', 'email', 'string'],
            'password' => ['required', 'string']
        ]); 

        $user = User::where('correo', $r->correo_electronico)->first();

        

        if ($user != null and Hash::check($r->password, $user->contraseña)) {
            //hacer login
            Auth::login($user);

            //generar el token csrf
            $r->session()->regenerate();

            $bienvenida = 'Bienvenido ' ;
            //redirecciona a dashboard con una variable status

            return //intended, por sin entra ua una url protegida
                redirect()->intended(Route('Dashboard'))
                ->with('status', $bienvenida);
        } //false, login incorrecto redireccionar devuelta login
        
        //NO SE ESTA OCUPANDO CREDENCIALES

        //filled, devuelve V o F si se dio click al inout recordar
        //$recordar = $r->filled('recordar');
        //TAMPOSE SE SETA USADNO DE MONETNO

        //sacar la tabla donde este esee correo
        // $user = User::where('correo_electronico', $r->correo_electronico)
        //     ->join('empleados as e','e.id_usuario','=','users.id')->first();


        //usandon el Hash::check
        //Hash::check //recibe texo plano password, luego la encriptada en la Tabla
        // if ($user != null and Hash::check($r->password, $user->password)) {
        //     //hacer login
        //     Auth::login($user);

        //     //generar el token csrf
        //     $r->session()->regenerate();

        //     $bienvenida = 'Bienvenido ' . ($user->nombre);
        //     //redirecciona a dashboard con una variable status

        //     return //intended, por sin entra ua una url protegida
        //         redirect()->intended(Route('Dashboard'))
        //         ->with('status', $bienvenida);
        // } //false, login incorrecto redireccionar devuelta login

                


        // //distafar un error de validacion
        // if ($user == null) { //si es nulo, significa que no encontro el correo
        //     throw ValidationException::withMessages([
        //         //meustra el eeroror del correo
        //         'correo' => 'Correo no encontrado',
        //     ]);
        // } else {
        //     throw ValidationException::withMessages([
        //         //meustra el eeroror del correo
        //         'password' => 'Contrasena Incorrecta',
        //     ]);
        // }
    }


    public function dashboard()
    {
        $hoy = date('Y-m-d');
        $mes = date('Y-m-d');
        $NuevaFecha = strtotime ( '-30 day' , strtotime ($mes) );
        $NuevaFecha = date ( 'Y-m-d' , $NuevaFecha);
        // dd($NuevaFecha);
        // $ventas_dia = Venta::where('fecha',$hoy)->sum('monto_total');
        // $ventas_mes = Venta::where('fecha','>=',$NuevaFecha)->sum('monto_total');
        // // dd($ventas_mes);
        // $user = Auth::user()->nombre_usuario;
        // $producto = Producto::join('proveedors','proveedors.id','=','productos.id_proveedor')
        //                         ->select('productos.*','proveedors.nombre_proveedor','proveedors.proveedor_direccion','proveedors.nombre_proveedor_contacto','proveedors.proveedor_telefono')->get();
        // dd($producto);
        return view('VistasAuth.dashboard');
    }



    public function logout(Request $r)
    {
      //    dd($r);
        Auth::logout();

        //invalidacion la seccion
       $r->session()->invalidate();

        //token crsf
      $r->session()->regenerateToken();

        return redirect()->Route('Login')->with('statusLogout', "Haz cerrado session");
    }
    /*
    By Julico
    funcion para realizar la peticion
    a la Base de Datos y regresar un resultado
    al frontend
    */
    public function show(Request $request)
    {
        $data = trim($request->valor);
        $result = DB::table('productos')
            ->where('cod_oem', 'like', '%' . $data . '%')
            ->orwhere('cod_sustituto', 'like', '%' . $data . '%')
            ->limit(5)
            ->get();
        return response()->json([
            "estado" => 1,
            "result" => $result
        ]);
    }
}
