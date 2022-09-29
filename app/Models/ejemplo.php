<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ejemplo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad'
    ];
}
