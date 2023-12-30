<?php

namespace App\Services;

use App\Models\Plan;

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
}
