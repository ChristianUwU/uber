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

    public function view(): View
    {
        $fecha_antes = Request('fecha_antes');
        $fecha_hasta = Request('fecha_hasta');
        return view('cliente.export', [
            // 'conductors' => Conductor::all(),
            'clientes' => Cliente::when(Request('fecha_antes'), function ($q) {
                if (is_null(Request('fecha_antes'))) {
                    return $q->get();
                }
                return $q->where('created_at', '>=', Request('fecha_antes'));
            })
                ->when(Request('fecha_antes'), function ($q) {
                    if (is_null(Request('fecha_antes'))) {
                        return $q->get();
                    }
                    return $q->where('created_at', '<=', Request('fecha_hasta'));
                })->get(),
        ]);
    }

    // public function collection()
    // {
    //     return Cliente::all();
    // }

}
