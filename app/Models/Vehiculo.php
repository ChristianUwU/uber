<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'anio',
        'estado',
        'foto_vehiculo',
        'papeles_vehiculo',
        'conductor_id',
    ];

    //metodo para recibir la foreing key
    public function user()
    {
        return $this->belongsTo(Conductor::class);
    }
}
