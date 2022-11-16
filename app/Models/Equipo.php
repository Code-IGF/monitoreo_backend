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
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function usuarios(){
        return $this->belongsToMany(User::class, 'equipo_usuarios');
    }
}
