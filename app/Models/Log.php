<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'descripcion',
        'user_id',
        'archivo_id'
    ];

    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function archivo(){
        return $this->hasMany(Archivo::class,'archivo_id');
    }
}
