<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'area_id',
        'supervisor'
    ];

    public function area(){
        return $this->belongsTo('App\Models\Area');
    }

    public function salaTrabajo(){
        return $this->hasMany(SalaTrabajo::class, "id_sala");
    }
    
}
