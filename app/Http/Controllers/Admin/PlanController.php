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
        $reserve_slots = Reserve_slot::with('room')->select('id', 'room_id', 'date','fee')->orderBy('date')->get();
        return view('admin.plan.create')->with('reserve_slots', $reserve_slots);
    }

    public function store(Request $request)
    {
        //チェックされた予約枠IDと料金の紐づけ
        // dd($request->all());
        //indexが予約枠ID、値が予約枠料金の連想配列
        $plan_fee = [];
        foreach ($request->reserve_slot as $reserve_slot) {
            $plan_fee[$reserve_slot] = $request->reserve_slot_fee[$reserve_slot];
        }
        // dd($plan_fee);

        $plan = Plan::create([
            'title' => $request->title,
            'description' => $request->description,
            'fee' => 10,
        ]);

        foreach ($plan_fee as $reserve_slot_id => $fee) {
            $plan_reserve_slot = Plan::findOrFail($plan->id);
            $plan_reserve_slot->planReserveSlot()->syncWithoutDetaching([
                $reserve_slot_id => ['fee' => $fee]
            ]);
        }
        // foreach ($request->reserve_slot as $reserve_slot) {

        //     $plan = Plan::findOrFail($plan->id);
        //     // $plan->planReserveSlot()->attach($reserve_slot, ['fee' => $request->fee]);
        //     $plan->planReserveSlot()->syncWithoutDetaching([
        //         $reserve_slot => ['fee' => $request->fee] 
        //       ]);
        // }
        return to_route('admin.plan.index');
    }
}
