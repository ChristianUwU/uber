<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'administrador_id',
        'ci',
        'foto',
        'fotoCI_Anverso',
        'fotoCI_Reverso',
        'fotoAntecedente',
        'fotoLicencia',
        'fotoTIC',
        'placa',
        'marca',
        'modelo',
        'anio',
        'fotoVehiculo',
        'fotoPapelesAuto',
        'estado',
        'detalle'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class,'cliente_id');
    }
}
