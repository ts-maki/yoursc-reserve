<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Services\PlanService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PlanController extends Controller
{

    
    public function __construct(public PlanService $planService) {
        
    }

    public function index()
    {

        $plans = $this->planService->getPlans();
        /* プラン一覧をプランに登録されている一番早い日付の予約枠の日付順に並び替える
        */
        $plans = $this->planService->sortByReserveDate($plans);

        return view('plan.index')->with('plans', $plans);
    }

    public function show($plan_id)
    {
        $plan = Plan::findOrFail($plan_id);
        return view('plan.show')->with('plan', $plan);
    }

    public function filterPlansByDate(Request $request)
    {

        $from = $request->from;
        $to = $request->to;
        // dd($request->all());
        $plans = $this->planService->getPlans();

        //日付範囲選択
        if (!empty($from) && !empty($to)) {
            Log::debug('日付範囲検索');
            $plans = $plans->filter(function ($plan) use ($from, $to) {
                foreach ($plan->planReserveSlots as $slot) {
                    $slots[] = $slot->reserveSlot->date;
                }
                $slots = collect($slots);
                foreach ($slots as $index => $slot) {
                    $is_date[] = $plan->planReserveSlots[$index]->whereBetween('date', [$from, $to]);
                    dd($is_date);
                }
                dd($is_date);
            });
        }

        //今日の予約枠をもつプラン一覧
        if ($request->has('today')) {

            Log::debug('今日検索');
            return view('plan.index')->with('plans', $plans);
        }

        //今日の予約枠をもつプラン一覧
        if ($request->has('tomorrow')) {
            Log::debug('明日検索');
            $tomorrow = Carbon::tomorrow()->format('Y-m-d');

            //filterが関数なので$tomorrowはuseを使って参照する
            $plans = $plans->filter(function ($plan) use($tomorrow) {
                foreach ($plan->planReserveSlots as $slot) {
                    $slots[] = $slot->reserveSlot->date;
                }
                
                //コレクションの関数が使えるようにコレクションにする
                $slots = collect($slots);
                $is_date = $slots->contains(function ($value) use ($tomorrow) {
                    return $value == $tomorrow;
                });

                if ($is_date !== false) {
                    return $plan;
                } else {
                    return $plan = [];
                }
            });

            $plans = $this->planService->sortByReserveDate($plans);
            return view('plan.index')->with('plans', $plans);
        };
        // dd($plans);
        return view('plan.index')->with('plans', $plans);
    }
}
