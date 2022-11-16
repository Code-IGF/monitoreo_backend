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

}
