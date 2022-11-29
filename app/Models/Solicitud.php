<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'ci',
        // 'estado',
        'fotoAntecedente',
        'fotoLicencia',
        'fotoTIC',
        'fotoPapelesAuto',
        'fotoCI_Anverso',
        'fotoCI_Reverso',
        'foto',
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class,'cliente_id');
    }
}
