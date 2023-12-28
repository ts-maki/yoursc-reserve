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
        $plans = Cache::remember('plans', 5, function () {
            return Plan::with('images:plan_id,path')->select('id', 'title', 'description')->get();
        });
        return view('plan.index')->with('plans', $plans);
    }

    public function show($plan_id)
    {
        $plan = Plan::findOrFail($plan_id);
        return view('plan.show')->with('plan', $plan);
    }
}
