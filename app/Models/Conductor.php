<?php

namespace App\Models;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conductor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cliente_id',
        'ci',
        'ocupado',
        'fotoAntecedente',
        'fotoLicencia',
        'fotoTIC',
        'CI_Anverso',
        'CI_Reverso',
        'foto'
    ];

    protected $dates = ['deleted_at'];

    public function cliente(){
        return $this->belongsTo(Cliente::class,'cliente_id');
    }
    //metodo para dar la primari key
    public function vehiculo(){
        return $this->hasMany(Vehiculo::class);
    }
}
