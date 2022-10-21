<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_chat',
        'sala_id',
        'usuario_id',
        'texto'
    ];
    public function sala(){
        return $this->belongsTo(Sala::class,'sala_id');
    }
   
}
