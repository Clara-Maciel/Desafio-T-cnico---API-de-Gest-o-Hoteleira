<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = ['id', 'name'];

    public $incrementing = false; 


    public function room(){
        return $this->hasMany(Room::class);
    }
    
    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }
}   