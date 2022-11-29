<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    public $table = "clientes"; // Especificar el nombre de la tabla

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'fecha_nacimiento',
        'foto',
    ];

    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    //metodo para dar la primari key
    public function Conductor(){
        return $this->hasMany(Conductor::class);
    }
}
