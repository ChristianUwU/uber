<?php

namespace App\Exports;

use App\Models\Conductor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ConductorsExport implements FromView
{

    public function view():View
    {
        $fecha_antes = Request('fecha_antes');
        $fecha_hasta = Request('fecha_hasta');
        return view('conductor.export',[
            // 'conductors' => Conductor::all(),
            'conductors' => Conductor::when(Request('fecha_antes'), function($q){
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
            })->get(),
        ]);
    }

    // public function collection()
    // {
    //     return Conductor::all();
    // }
}
