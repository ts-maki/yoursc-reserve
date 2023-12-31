<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Plan_reserve_slot;
use App\Models\Reserve_slot;
use App\Services\PlanService;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Str;

class PlanDetailController extends Controller
{

    public function __construct(public PlanService $planService)
    {
    }

    public function show($plan_id)
    {
        // dd(env('APP_URL'). '/plan/'. $plan_id);
        $plan = Plan::findOrFail($plan_id);

        //プランに該当のroom_idがあるか
        $is_jp_room = $plan->planReserveSlots->contains(function ($is_room) {
            return $is_room->reserveSlot->room_id === 1;
        });

        $is_wes_room = $plan->planReserveSlots->contains(function ($is_room) {
            return $is_room->reserveSlot->room_id === 2;
        });

        $is_mix_room = $plan->planReserveSlots->contains(function ($is_room) {
            return $is_room->reserveSlot->room_id === 3;
        });

        $is_party_room = $plan->planReserveSlots->contains(function ($is_room) {
            return $is_room->reserveSlot->room_id === 4;
        });

        return view('plan.show')->with('plan', $plan)
            ->with('is_jp_room', $is_jp_room)
            ->with('is_wes_room', $is_wes_room)
            ->with('is_mix_room', $is_mix_room)
            ->with('is_party_room', $is_party_room);

    }

    public function index($plan_id)
    {

        //プランに紐づくプランと予約枠の関係レコード取得
        $plan_reserve_slots = Plan_reserve_slot::where('plan_id', $plan_id)->select('reserve_slot_id', 'fee');

        $plan_fees = $plan_reserve_slots->orderBy('reserve_slot_id')->pluck('fee');

        $plan_reserve_slots_ids = $plan_reserve_slots->pluck('reserve_slot_id');

        $reserve_slots = Reserve_slot::with('room')->whereIn('id', $plan_reserve_slots_ids)->orderBy('id')->get();

        if (url()->current() == env('APP_URL'). '/events/'. $plan_id) {
            // dd(env('APP_URL'). '/'. $plan_id);
            $room = 'all';

            $plan_reserve_slots = Plan_reserve_slot::where('plan_id', $plan_id)->select('reserve_slot_id', 'fee');
            $events = $this->planService->getEventsByRoom($plan_reserve_slots, $room, $plan_id);
            return $events;
        }

        //部屋タイプ別にフルカレンダーに送るeventsをわける
        if (Str::contains(url()->current(), 'jp-room')) {
            $room = 'jp-room';
            $events = $this->planService->getEventsByRoom($plan_reserve_slots, $room, $plan_id);
            return $events;
        }

        if (Str::contains(url()->current(), 'wes-room')) {
            $room = 'wes-room';
            $events = $this->planService->getEventsByRoom($plan_reserve_slots, $room, $plan_id);
            return $events;
        }

        if (Str::contains(url()->current(), 'mix-room')) {
            $room = 'mix-room';
            $events = $this->planService->getEventsByRoom($plan_reserve_slots, $room, $plan_id);
            return $events;
        }

        if (Str::contains(url()->current(), 'party-room')) {
            $room = 'party-room';
            $events = $this->planService->getEventsByRoom($plan_reserve_slots, $room, $plan_id);
            return $events;
        }

    }
}
