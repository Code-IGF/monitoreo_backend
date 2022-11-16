<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $fillable=[
        'texto',
        'sala_trabajo_id',
        'user_id'
        
    ];
    public function sala(){
        return $this->belongsTo(Sala::class,'sala_trabajo_id');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');
    }
   
}
