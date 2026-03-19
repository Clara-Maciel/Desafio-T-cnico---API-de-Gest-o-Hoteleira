<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('hotel')->get();
        return response()->json($rooms);
    }

    public function show($id)
    {
        $room = Room::with('hotel')->find($id);

        if (!$room) {
            return response()->json(['message' => 'Quarto não encontrado'], 404);
        }

        return response()->json($room);
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id'        => 'required|exists:hotels,id',
            'name'            => 'required|string',
            'inventory_count' => 'required|integer|min:1',
        ]);

        $data = $request->all();
        $data['id'] = time();

        $room = Room::create($data);
        return response()->json($room, 201);
    }

    public function update(Request $request, $id)
    {
        $room = Room::find($id);

        if (!$room) {
            return response()->json(['message' => 'Quarto não encontrado'], 404);
        }

        $request->validate([
            'name'            => 'sometimes|string',
            'inventory_count' => 'sometimes|integer|min:1',
        ]);

        $room->update($request->all());
        return response()->json($room);
    }

    public function destroy($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return response()->json(['message' => 'Quarto não encontrado'], 404);
        }

        $room->delete();
        return response()->json(['message' => 'Quarto excluído com sucesso']);
    }
}