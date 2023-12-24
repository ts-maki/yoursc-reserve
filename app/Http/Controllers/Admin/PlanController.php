<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Plan;
use App\Models\Plan_reserve_slot;
use App\Models\Reserve_slot;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $images = Image::with('plan')->select('plan_id', 'path')->get();
        $plans = Plan::select('title', 'description')->get();
        return view('admin.plan.index')
            ->with('plans', $plans)
            ->with('images', $images);
    }
    
    public function create()
    {
        $reserve_slots = Reserve_slot::with('room')->select('id', 'room_id', 'date')->orderBy('date')->get();
        return view('admin.plan.create')->with('reserve_slots', $reserve_slots);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        //チェックされた予約枠IDと料金の紐づけ
        // dd($request->all());
        //indexが予約枠ID、値が予約枠料金の連想配列
        // dd($request->file('image'));

        $plan = Plan::create([
            'title' => $request->title,
            'description' => $request->description,
            'fee' => 10,
        ]);

        foreach ($request->file('image') as $index => $file) {
            $file_name = $file->getClientOriginalName();
            $file_path = 'storage/images/'. $file_name;
            // dd($file_path);
            $path = $file->storeAs('images', $file_name, 'public');
            Image::create([
                'plan_id' => $plan->id,
                'path' => $file_path
            ]);
        }
        // dd($path);
        $plan_fee = [];
        foreach ($request->reserve_slot as $reserve_slot) {
            $plan_fee[$reserve_slot] = $request->reserve_slot_fee[$reserve_slot];
        }
        // dd($plan_fee);


        foreach ($plan_fee as $reserve_slot_id => $fee) {
            $plan_reserve_slot = Plan::findOrFail($plan->id);
            $plan_reserve_slot->planReserveSlot()->syncWithoutDetaching([
                $reserve_slot_id => ['fee' => $fee]
            ]);
        }

        return to_route('admin.plan.index');
    }
}
