<?php

namespace App\Http\Controllers\API;

use App\Models\Conductor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConductorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $request->validate([
            'foto' => ['image'],
            'CI_Anverso' => ['image'],
            'CI_Reverso' => ['image'],
            'fotoAntecedentes' => ['image'],
            'fotoLicencia' => ['image'],
            'fotoTIC' => ['image'],
        ]);

        $cliente_id = auth()->user->cliente->id;

        

        $conductor = Conductor::Create([
            'cliente_id' => $cliente_id,

        ]);
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
}
