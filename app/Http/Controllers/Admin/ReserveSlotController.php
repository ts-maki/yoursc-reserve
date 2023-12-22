<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reserve_slot;
use App\Models\Room;
use Illuminate\Http\Request;

class ReserveSlotController extends Controller
{
    public function index()
    {
        $reserve_slots = Reserve_slot::with('room')->get();
        return view('admin.reserve_slot.index')->with('reserve_slots', $reserve_slots);
    }

    public function create()
    {
        $rooms = Room::all();
        return view('admin.reserve_slot.create')->with('rooms', $rooms);
    }

    public function store(Request $request)
    {
        $reserve_slot = Reserve_slot::create([
            'room_id' => $request->room_id,
            'date' => $request->date,
            'fee' => $request->fee,
            'number_of_rooms' => $request->number_of_rooms,
        ]);

        return to_route('admin.reserve_slot.index');
    }

    public function edit($reserve_slot_id)
    {
        $rooms = Room::all();
        $reserve_slot = Reserve_slot::findOrFail($reserve_slot_id);
        return view('admin.reserve_slot.edit')
            ->with('reserve_slot', $reserve_slot)
            ->with('rooms', $rooms);
    }

    public function update(Request $request, $reserve_slot_id)
    {
        $reserve_slot = Reserve_slot::findOrFail($reserve_slot_id);
        $reserve_slot->fill($request->all())->save();

        return to_route('admin.reserve_slot.index');
    }

    public function destroy($reserve_slot_id)
    {
        $reserve_slot = Reserve_slot::destroy($reserve_slot_id);
        
        return to_route('admin.reserve_slot.index');
    }
}
