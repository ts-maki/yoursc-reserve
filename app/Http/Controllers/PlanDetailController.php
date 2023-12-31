<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Plan_reserve_slot;
use App\Models\Reserve_slot;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use PhpParser\Node\Stmt\Foreach_;

class PlanDetailController extends Controller
{

    public function show($plan_id)
    {
        $plan = Plan::findOrFail($plan_id);

        $plan_reserve_slots = Plan_reserve_slot::where('plan_id', $plan_id)->select('reserve_slot_id', 'fee');
        $plan_fees = $plan_reserve_slots->pluck('fee')->sortBy('reserve_slot_id');
        // dd($plan_fees);
        $reserve_slots = Reserve_slot::whereIn('id', $plan_reserve_slots->pluck('reserve_slot_id'))->orderBy('id')->get();
        // dd($reserve_slots);

        foreach ($reserve_slots as $index => $reserve_slot) {
            $events[$index]['id'] = $reserve_slot->id;
            $events[$index]['title'] = Number::format($plan_fees[$index]). '円';
            $events[$index]['start'] = $reserve_slot->date;
        }

        return view('plan.show')->with('plan', $plan);
    }


    public function index($plan_id)
    {
        $plan_reserve_slots = Plan_reserve_slot::where('plan_id', $plan_id)->select('reserve_slot_id', 'fee');
        $plan_fees = $plan_reserve_slots->pluck('fee')->sortBy('reserve_slot_id');
        // dd($plan_fees);
        $reserve_slots = Reserve_slot::whereIn('id', $plan_reserve_slots->pluck('reserve_slot_id'))->orderBy('id')->get();
        // dd($reserve_slots);

        foreach ($reserve_slots as $index => $reserve_slot) {
            $events[$index]['id'] = $reserve_slot->id;
            $events[$index]['title'] = Number::format($plan_fees[$index]). '円';
            $events[$index]['start'] = $reserve_slot->date;
        }
        
        // return view('plan.show')->with('plan_id', $plan_id);
        return response()->json($events);
    }
}
