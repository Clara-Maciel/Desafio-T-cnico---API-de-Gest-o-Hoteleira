<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'hotel_id'         => 'required|exists:hotels,id',
            'room_id'          => 'required|exists:rooms,id',
            'guest_first_name' => 'required|string',
            'guest_last_name'  => 'required|string',
            'arrival_date'     => 'required|date',
            'departure_date'   => 'required|date|after:arrival_date',
            'meal_plan'        => 'required|string',
            'guest_count'      => 'required|integer|min:1',
            'total_price'      => 'required|numeric|min:0',
            'currency_code'    => 'required|string|size:3',
        ]);

        $data = $request->all();
        $data['id'] = time();

        $reservation = Reservation::create($data);
        return response()->json($reservation, 201);
    }
}