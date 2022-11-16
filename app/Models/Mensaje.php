<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $fillable=[
        'texto',
        'sala_id',
        'usuario_id'
        
    ];
    public function sala(){
        return $this->belongsTo(Sala::class,'sala_id');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id');
    }
   
}
