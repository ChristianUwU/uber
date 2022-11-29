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
        $clientes = DB::table('users')
                ->select('nombre', 'apellido', 'telefono')
                ->join('clientes', 'users.id', '=', 'clientes.user_id')
                ->paginate(10);
            
        return view('cliente.index', ['clientes' => $clientes]);
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


    public function downloadPDF(Cliente $cliente)
    {

        $clientes = Cliente::all();
        
        view()->share('cliente.download', $clientes);
        // $pdf = PDF::loadView('cliente.download',['clientes'=>$clientes]);
        // return $pdf->download('Lista de Clientes' . '.pdf'); //Para que descargue directo el pdf
        $pdf = Pdf::loadView('Cliente.download', ['clientes' => $clientes])
            ->setPaper('letter', 'portrait');

        return $pdf->stream('Lista de Clientes' . '.pdf', ['Attachment' => 'true']);

    }

    public function exportExcel()
    {
        return Excel::download(new ClientesExport,'repo-clientes.xlsx');
    }

    public function exportHtml()
    {
        return Excel::download(new ClientesExport,'repo-clientes.html');
    }

}
