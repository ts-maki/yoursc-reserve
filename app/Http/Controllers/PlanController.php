<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PlanController extends Controller
{
    public function index()
    {
        // $plans = Cache::remember('plans', config('global.cache.time'), function () {
        //     return Plan::with(['images:plan_id,path', 'planReserveSlots.reserveSlot'])->get();
        // });

        $plans = Plan::with(['images:plan_id,path', 'planReserveSlots.reserveSlot'])->get();

        /* プラン一覧をプランに登録されている一番早い日付の予約枠の日付順に並び替える
        */
        $plans = $plans->sortBy(function ($plan) {
            return $plan->planReserveSlots->sortBy(function ($reserve_slot_date) {
                return $reserve_slot_date->reserveSlot->date;
            })->first()->reserveSlot->date;
        });

        return view('plan.index')->with('plans', $plans);
    }

    public function show($plan_id)
    {
        $plan = Plan::findOrFail($plan_id);
        return view('plan.show')->with('plan', $plan);
    }

    public function filterPlansByDate(Request $request)
    {
        //日付範囲検索
        // dd($request->all());
        // dd($request->has('tomorrow'));
        $from = $request->from;
        $to = $request->to;
        // dd($request->all());

        if (!empty($request->from) && !empty($request->to)) {
            dd('hai');

            $plans = Plan::with(['images:plan_id,path', 'planReserveSlots.reserveSlot'])->get();

            //宿泊プランの全部の予約枠の日にち
            $reserve_slot_dates = [];
            foreach ($plans as $plan) {
                foreach ($plan->planReserveSlots as $reserve_slot) {
                    // dd($reserve_slot);
                    $reserve_slot_dates[] = $reserve_slot->reserveSlot->date;
                }
            }

            $filter_plans = $plans->filter(function ($plan) use ($from, $to) {

                return $plan->planReserveSlots->filter(function ($reserve_slot) use ($from, $to) {
                    dd(
                        $from,
                        $to,
                        $reserve_slot->reserveSlot->date,
                        $reserve_slot->reserveSlot->whereBetween('date', [$from, $to]),
                        $reserve_slot->reserveSlot->whereBetween('date', [$from, $to])->exists()
                    );
                    // dd($reserve_slot->reserveSlot->whereBetween('date', [$from, $to])->exists());
                    return $reserve_slot->reserveSlot->whereBetween('date', [$from, $to]);
                });
            });
            // return view('plan.index')->with('plans', $filter_plans);
        }

        if ($request->has('today')) {
            $plans = Plan::with(['images:plan_id,path', 'planReserveSlots.reserveSlot'])->get();
            Log::debug('今日検索');

            return view('plan.index')->with('plans', $plans);
        }

        if ($request->has('tomorrow')) {
            Log::debug('明日検索');




            $plans = Plan::with(['images:plan_id,path', 'planReserveSlots.reserveSlot'])->get();
            $tomorrow = Carbon::tomorrow()->format('Y-m-d');

            // dd($tomorrow);

            //宿泊プランと予約枠の関係と予約枠テーブルをjoin
            // $join_plan_reserves = DB::table('plan_reserve_slots')
            //     ->select('plan_reserve_slots.plan_id', 'plan_reserve_slots.reserve_slot_id', 'reserve_slots.date')
            //     ->join('reserve_slots', 'plan_reserve_slots.reserve_slot_id', '=', 'reserve_slots.id')->get();
            $filter = [];
            $plans = $plans->filter(function ($plan) use ($tomorrow) {
                foreach ($plan->planReserveSlots as $slot) {
                    $filter[] = $slot->reserveSlot->date;
                }
                // dd($filter);
                $filter = collect($filter);
                $is_date = $filter->contains(function ($value) use ($tomorrow) {
                    return $value == $tomorrow;
                });
                // dd($is_date);
                if ($is_date !== false) {
                    return $plan;
                } else {
                    return $plan = null;
                }
                dd($plan);
            });
            // dd($plans);
            
            // $plans = $plans->map(function ($plan, $tomorrow) {
            //     $filter = $plan->pluck($plan->planReserveSlots[0]->reserveSlot->date);
            //     dd($filter);
            // });
            return view('plan.index')->with('plans', $plans);
        };
        // dd($plans);
        return view('plan.index')->with('plans', $plans);
    }
}
