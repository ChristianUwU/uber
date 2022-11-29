<?php

namespace App\Exports;

use App\Models\Vehiculo;
use Maatwebsite\Excel\Concerns\FromCollection;

class VehiculoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $fecha_antes = Request('fecha_antes');
        $fecha_hasta = Request('fecha_hasta');
        return Vehiculo::when(Request('fecha_antes'), function ($q) {
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
            })->get();
    }
}
