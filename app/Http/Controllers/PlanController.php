<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Reserve_slot;
use App\Services\PlanService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PlanController extends Controller
{



    public function __construct(public PlanService $planService)
    {
    }

    public function index()
    {
        $plans = $this->planService->getPlans();
        /* プラン一覧をプランに登録されている一番早い日付の予約枠の日付順に並び替える
        */
        $plans = $this->planService->sortByReserveDate($plans);
        return view('plan.index')->with('plans', $plans)
            ->with('date', 'today');
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


        //今日の予約枠をもつプラン一覧
        if ($request->has('today')) {

            Log::debug('今日検索');
            $date = 'today';
            return view('plan.index')->with('plans', $plans)->with('date', 'today');
        }

        //明日の予約枠をもつプラン一覧
        if ($request->has('tomorrow') || ($from == date("Y-m-d", strtotime("tomorrow")) && $to == date("Y-m-d", strtotime("tomorrow")))) {
            // dd(date("Y-m-d",strtotime("tomorrow")));
            Log::debug('明日検索');
            $tomorrow = Carbon::tomorrow()->format('Y-m-d');

            //filterが関数なので$tomorrowはuseを使って参照する
            $plans = $plans->filter(function ($plan) use ($tomorrow) {
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
                    return $plan = null;
                }
            });

            $plans = $this->planService->sortByReserveDate($plans);
            return view('plan.index')->with('plans', $plans)->with('date', 'tomorrow');
        };

        //日付範囲選択
        if (!empty($from) && !empty($to)) {

            //日付検索で今日で検索した場合
            if ($from == date('Y-m-d') && $to == date('Y-m-d')) {
                Log::debug('今日検索');
                return view('plan.index')->with('plans', $plans)->with('date', 'today');
            }

            Log::debug('日付範囲検索');
            $plans = $plans->filter(function ($plan) use ($from, $to) {
                foreach ($plan->planReserveSlots as $slot) {
                    $slots[] = $slot->reserveSlot->date;
                    $reserve_slot_ids[] = $slot->reserveSlot->id;
                }
                $slots = collect($slots);

                //TODO plansからのリレーションのみでできないか検討
                // foreach ($slots as $index => $slot) {
                //     $is_date[] = $plan->planReserveSlots[$index]->whereBetween('date', [$from, $to]);
                //     dd($is_date);
                // }
                // dd($is_date);

                //planからのリレーションからこだわっていたが、予約枠テーブルからの手法を試みる

                //プランに紐づくレコードを予約枠テーブルから抽出
                $reserve_slots = Reserve_slot::whereIn('id', $reserve_slot_ids)->get();

                $filter_plans = $reserve_slots->whereBetween('date', [$from, $to]);

                //日付検索範囲内の予約枠をもつプランをかえす
                if (count($filter_plans) > 0) {
                    Log::debug('!!!日付検索範囲内にある!!!=>' . '範囲' . $from . '～' . $to, ['プランID:' . $plan->id . ',', '予約枠ID:' . implode(',', $reserve_slot_ids)]);
                    return $plan;
                } else {
                    Log::debug('日付検索範囲内になし=>' . '範囲' . $from . '～' . $to);
                    return $plan = [];
                }
            });

            return view('plan.index')->with('plans', $plans)
                ->with('from', $from)
                ->with('to', $to)
                ->with('date', 'filter');
        }

        // dd($plans);
        return view('plan.index')->with('plans', $plans);
    }
}
