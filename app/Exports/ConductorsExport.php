<?php

namespace App\Exports;

use App\Models\Conductor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ConductorsExport implements FromView
{

    public function view():View
    {
        return view('conductor.export',[
            'conductors' => Conductor::all(),
        ]);
    }

    // public function collection()
    // {
    //     return Conductor::all();
    // }
}
