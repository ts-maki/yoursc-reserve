<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Plan_reserve_slot;
use App\Models\Reserve_slot;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return view('admin.plan.index');
    }
    
    public function create()
    {
        $reserve_slots = Reserve_slot::with('room')->select('id', 'room_id', 'date')->orderBy('date')->get();
        return view('admin.plan.create')->with('reserve_slots', $reserve_slots);
    }

    public function store(Request $request)
    {

        $plan = Plan::create([
            'title' => $request->title,
            'description' => $request->description,
            'fee' => 10,
        ]);

        foreach ($request->reserve_slot as $reserve_slot) {

            $plan = Plan::findOrFail($plan->id);
            // $plan->planReserveSlot()->attach($reserve_slot, ['fee' => $request->fee]);
            $plan->planReserveSlot()->syncWithoutDetaching([
                $reserve_slot => ['fee' => $request->fee] 
              ]);
        }
        return to_route('admin.plan.index');
    }
}
