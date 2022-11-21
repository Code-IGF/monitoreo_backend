<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaTrabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_sala',
        'hora_entrada',
        'hora_salida',
        'intervalo_conexion',
        'equipos_id'
    ];

    public function equipos(){
        return $this->belongsTo(Equipo::class, "equipos_id");
    }


}
