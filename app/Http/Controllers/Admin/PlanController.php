<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Plan;
use App\Models\Reserve_slot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::with('images')->get();

        $has_reserve_slot = DB::table('reserve_slots')->exists();
        return view('admin.plan.index')
            ->with('plans', $plans)
            ->with('has_reserve_slot', $has_reserve_slot);
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
        ]);

        foreach ($request->file('image') as $index => $file) {
            $file_name = $file->getClientOriginalName();
            $file_path = 'storage/images/'. $file_name;

            $path = $file->storeAs('images', $file_name, 'public');
            Image::create([
                'plan_id' => $plan->id,
                'path' => $file_path
            ]);
        }

        $plan_fee = [];
        foreach ($request->reserve_slot as $reserve_slot) {
            $plan_fee[$reserve_slot] = $request->reserve_slot_fee[$reserve_slot];
        }

        //宿泊プランとプランに紐づく各予約枠の料金
        foreach ($plan_fee as $reserve_slot_id => $fee) {
            $plan_reserve_slot = Plan::findOrFail($plan->id);
            $plan_reserve_slot->planReserveSlot()->syncWithoutDetaching([
                $reserve_slot_id => ['fee' => $fee]
            ]);
        }

        return to_route('admin.plan.index');
    }

}
