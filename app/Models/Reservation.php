<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'id',
        'hotel_id',
        'room_id',
        'guest_first_name',
        'guest_last_name',
        'arrival_date',
        'departure_date',
        'meal_plan',
        'guest_count',
        'total_price',
        'currency_code'
    ];

    public $incrementing = false;

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
