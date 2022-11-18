<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaTrabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_sala'
    ];

    public function equipos(){
        return $this->hasOne('App\Models\Equipo');
    }

    public function configuracion(){
<<<<<<< HEAD
        return $this->belongsTo(Configuracion::class, 'configuracion_id');
    }

    public function equipo(){
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }
=======
        return $this->belongsTo(Configuracion::class, "configuracion_id");
    }
    public function equipo(){
        return $this->belongsTo(Equipo::class, "equipo_id");
    }

>>>>>>> 69c723c1c9e8e56cc3aa41791cdd379d9d230f22
}
