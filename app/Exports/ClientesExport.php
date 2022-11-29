<?php

namespace App\Exports;

use App\Models\Cliente;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClientesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view():View
    {
        return view('cliente.export',[
            'clientes' =>Cliente::all(),
        ]);
    }

    // public function collection()
    // {
    //     return Cliente::all();
    // }

}
