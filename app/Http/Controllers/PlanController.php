<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PlanController extends Controller
{
    public function index()
    {
        // TODO config('global.cache.time');が読み込めない
        // dd(config('global.cache.time'));
        //画像のEagerロードと日付順に並び替えた関連先の予約枠を取得
        $plans = Cache::remember('plans', 1, function () {
            return Plan::with(['images:plan_id,path', 'planReserveSlots.reserveSlot' => function($query) {
                return $query->orderBy('date');
            } ])->get();
        });

        /* プラン一覧をプランに登録されている一番早い日付の予約枠の日付順に並び替える
        比較対象のプランのプランと予約枠の関係を予約枠が一番早い順に並び替える
        →並び替えたレコードのはじめの日付を取得する
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
}
