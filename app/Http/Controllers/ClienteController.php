<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientesExport;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fecha_antes = Request('fecha_antes');
        $fecha_hasta = Request('fecha_hasta');
        $clientes = DB::table('users')
                ->select('nombre', 'apellido', 'telefono')
                ->join('clientes', 'users.id', '=', 'clientes.user_id')
                ->when(Request('fecha_antes'), function($q){
                    return $q->where('created_at','>=',Request('fecha_antes'));
                })
                ->when(Request('fecha_antes'), function($q){
                    return $q->where('created_at','<=',Request('fecha_hasta'));
                })->get();

        return view('cliente.index', compact('clientes','fecha_antes','fecha_hasta'));
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
        //
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

    public function export(Request $q)
    {
        // dd($q);
        if($q->formato == 1){
            // return Excel::download(new ConductorsExport,'repo-conductor.xlsx');
            return Excel::download(new ClientesExport,'repo-clientes.xlsx');
        }else{
            if($q->formato == 3){
                // return Excel::download(new ConductorsExport,'repo-conductor.html');
                return Excel::download(new ClientesExport,'repo-clientes.html');
            }else{
                $fecha_antes = Request('fecha_antes');
                $fecha_hasta = Request('fecha_hasta');
                $clientes = Cliente::when(Request('fecha_antes'), function($q){
                    if(is_null(Request('fecha_antes'))){
                        return $q->get();
                    }
                    return $q->where('created_at','>=',Request('fecha_antes'));
                })
                ->when(Request('fecha_antes'), function($q){
                    if(is_null(Request('fecha_antes'))){
                        return $q->get();
                    }
                    return $q->where('created_at','<=',Request('fecha_hasta'));
                })->get();
                view()->share('cliente.download', $clientes);
                $pdf = Pdf::loadView('Cliente.download', ['clientes' => $clientes])->setPaper('letter', 'portrait');
                return $pdf->download('Lista de Clientes' . '.pdf', ['Attachment' => 'false']);
            }
        }
    }


}
