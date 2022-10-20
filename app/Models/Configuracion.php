<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_configuracion',
        'hora_entrada',
        'hora_salida',
        'intervalo_conexion'
    ];
}
