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
        return view('plan.show')->with('plan', $plan);
    }


    public function index($plan_id, $room_id = null)
    {

        $plan_reserve_slots = Plan_reserve_slot::where('plan_id', $plan_id)->select('reserve_slot_id', 'fee');
        $plan_fees = $plan_reserve_slots->pluck('fee')->sortBy('reserve_slot_id');
        // dd($plan_fees);
        $reserve_slots = Reserve_slot::with('room')->whereIn('id', $plan_reserve_slots->pluck('reserve_slot_id'))->orderBy('id')->get();
        // dd($reserve_slots);

        foreach ($reserve_slots as $index => $reserve_slot) {
            $events[$index]['id'] = $reserve_slot->id;
            $events[$index]['title'] = $reserve_slot->room->name . ' ' . Number::format($plan_fees[$index]) . '円';
            $events[$index]['start'] = $reserve_slot->date;
            switch ($reserve_slot->room->id) {
                case 1:
                    $events[$index]['backgroundColor'] = '#ff8000';
                    $events[$index]['borderColor'] = '#ff8000';
                    break;
                case 2:
                    $events[$index]['backgroundColor'] = '#1e90ff';
                    $events[$index]['borderColor'] = '#1e90ff';
                    break;
                case 3:
                    $events[$index]['backgroundColor'] = '#3cb371';
                    $events[$index]['borderColor'] = '#3cb371';
                    break;
                case 4:
                    $events[$index]['backgroundColor'] = '#bdb76b';
                    $events[$index]['borderColor'] = '#bdb76b';
                    break;
                default:
                $events[$index]['backgroundColor'] = '#ff8000';
                $events[$index]['borderColor'] = '#ff8000';
                    break;
            }
            $events[$index]['url'] = '/plan/' . $plan_id . '/reserve/' . $reserve_slot->id;
        }

        // return view('plan.show')->with('plan_id', $plan_id);
        return response()->json($events);
    }
}
