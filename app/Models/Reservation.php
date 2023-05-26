<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['id_user','phone','date','time'];

    public static function insertarReservas($datosReserva){
        return self::create($datosReserva);
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

}
