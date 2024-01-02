<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Reserve_slot;
use Illuminate\Support\Number;

readonly class PlanService
{

    //プランを取得する
    public function getPlans()
    {
        $plans = Plan::with(['images:plan_id,path', 'planReserveSlots.reserveSlot'])->get();

        return $plans;
    }

    //プラン一覧を予約枠の日付順に並べる
    public function sortByReserveDate($plans)
    {
        $plans = $plans->sortBy(function ($plan) {
            return $plan->planReserveSlots->sortBy(function ($reserve_slot_date) {
                return $reserve_slot_date->reserveSlot->date;
            })->first()->reserveSlot->date;
        });

        return $plans;
    }

    //空室状況表示関数
    public function getRoomStatus($number_of_reserve_slot)
    {
        if ($number_of_reserve_slot > 2) {
            return '〇';
        } else if ($number_of_reserve_slot == 0) {
            return '×';
        } else {
            return '△';
        }
    }

    //フルカレンダーのevents作成
    public function getEventsByRoom($plan_reserve_slots, $room, $plan_id)
    {

        $plan_fees = $plan_reserve_slots->orderBy('reserve_slot_id')->pluck('fee');

        $plan_reserve_slots_ids = $plan_reserve_slots->pluck('reserve_slot_id');

        $reserve_slots = Reserve_slot::with('room')->whereIn('id', $plan_reserve_slots_ids)->orderBy('id');

        if (!empty($room)) {
            switch ($room) {
                case 'all':
                    $reserve_slots = $reserve_slots->orderBy('id')->get();
                    //空だったらeventsの配列を作成せずに空を返す
                    if (empty($reserve_slots)) {
                        $events = [[]];
                        dd($events = [[]]);
                        return $events = [[]];
                    }
                    $ids = $reserve_slots->sortBy('id')->pluck('id');
                    $plan_fees = $plan_reserve_slots->whereIn('reserve_slot_id', $ids)->orderBy('reserve_slot_id')->pluck('fee');
                    // dd($reserve_slots, $plan_fees);
                    break;
                case 'jp-room':
                    $reserve_slots = $reserve_slots->where('room_id', 1)->orderBy('id')->get();
                    //空だったらeventsの配列を作成せずに空を返す
                    if (empty($reserve_slots)) {
                        $events = [[]];
                        dd($events = [[]]);
                        return $events = [[]];
                    }
                    $ids = $reserve_slots->sortBy('id')->pluck('id');
                    $plan_fees = $plan_reserve_slots->whereIn('reserve_slot_id', $ids)->orderBy('reserve_slot_id')->pluck('fee');
                    // dd($reserve_slots, $plan_fees);
                    break;
                case 'wes-room':
                    $reserve_slots = $reserve_slots->where('room_id', 2)->orderBy('id')->get();
                    if (empty($reserve_slots)) {
                        $events = [[]];
                        dd($events = [[]]);
                        return $events = [[]];
                    }
                    $ids = $reserve_slots->sortBy('id')->pluck('id');
                    $plan_fees = $plan_reserve_slots->whereIn('reserve_slot_id', $ids)->orderBy('reserve_slot_id')->pluck('fee');
                    break;
                case 'mix-room':
                    $reserve_slots = $reserve_slots->where('room_id', 3)->orderBy('id')->get();
                    if (empty($reserve_slots)) {
                        $events = [[]];
                        dd($events = [[]]);
                        return $events = [[]];
                    }
                    $ids = $reserve_slots->sortBy('id')->pluck('id');
                    $plan_fees = $plan_reserve_slots->whereIn('reserve_slot_id', $ids)->orderBy('reserve_slot_id')->pluck('fee');
                    break;
                case 'party-room':
                    $reserve_slots = $reserve_slots->where('room_id', 4)->orderBy('id')->get();
                    if (empty($reserve_slots)) {
                        $events = [[]];
                        dd($events = [[]]);
                        return $events = [[]];
                    }
                    $ids = $reserve_slots->sortBy('id')->pluck('id');
                    $plan_fees = $plan_reserve_slots->whereIn('reserve_slot_id', $ids)->orderBy('reserve_slot_id')->pluck('fee');
                    break;

                default:

                    break;
            }
        }

        if (!empty($reserve_slots)) {

            
            foreach ($reserve_slots as $index => $reserve_slot) {
                $reserve_status = $this->getRoomStatus($reserve_slot->number_of_rooms);

                $events[$index]['id'] = $reserve_slot->id;
                $events[$index]['title'] = $reserve_status. ' '. $reserve_slot->room->name . ' ' . Number::format($plan_fees[$index]) . '円';
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

            return $events;
        }
    }
}
