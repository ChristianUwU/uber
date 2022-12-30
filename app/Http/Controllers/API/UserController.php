<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
        // $users = User::paginate(15);

        // softDelte se debe especificar con query builder
        $users = DB::table('users')
                ->select('id', 'nombre', 'apellido', 'email', 'telefono')
                ->where('deleted_at', null)  // Datos Activados
                ->orderBy('apellido')
                ->paginate(15);

        return response($users, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $image = str_replace('public', 'storage', $user->cliente->foto);

        $response = [
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'nombre' => $user->nombre,
                'apellido' => $user->apellido,
                'telefono' => $user->telefono,
                'role' => $user->getRoleNames(),
                'is_driver' => $user->is_driver,
            ],
            'image' => $image,
        ];

        return response($response, 200);
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
            'email' => ['string', 'email', 'max:255', 'unique:users'],
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
        if ($request->hasFile('foto')) {
            if ($fotoCliente != '') { // Eliminar foto anterior
                Storage::delete($fotoCliente);
            }
            $newFotoCliente = $request->file('foto')->store('public/cliente');
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

        $cliente->foto = $newFotoCliente ?? '';
        $cliente->update();
        
        $response = [
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'nombre' => $user->nombre,
                'apellido' => $user->apellido,
                'telefono' => $user->telefono,
                'role' => $user->getRoleNames(),
                'is_driver' => $user->is_driver,
            ],
            'image' => str_replace('public', 'storage', $user->cliente->foto) ?? '',
        ];
        
        return response($response, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $cliente = $user->cliente;
        $fotoCliente = $cliente->foto;
        
        if ($fotoCliente != '') { // Eliminar foto anterior
            Storage::delete($fotoCliente);
        }

        $cliente->delete();
        $user->delete();

        return response([
            'message' => 'Usuario eliminado corectamente'
        ], 201);
    }

    public function restore($id) 
    {
        // Buscamos en registro desactivados
        $user = User::onlyTrashed()->find($id);

        $user->restore();

        return response(['message' => 'Usuario Restaurado'], 201);
    } 

    public function getDetail() 
    {
        $user = auth()->user();

        $response = [
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'nombre' => $user->nombre,
                'apellido' => $user->apellido,
                'telefono' => $user->telefono,
                'role' => $user->getRoleNames(),
                'is_driver' => $user->is_driver,
            ],
            'image' => str_replace('public', 'storage', $user->cliente->foto),
        ];

        return response($response, 200);    
    }

}
