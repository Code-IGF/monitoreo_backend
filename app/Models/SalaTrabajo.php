<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaTrabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_sala',
        'configuracion_id',
        'equipos_id'
    ];

    public function equipos(){
        return $this->belongsTo(Equipo::class, "equipos_id");
    }

    public function configuracion(){
        return $this->belongsTo(Configuracion::class, "configuracion_id");
    }

}
