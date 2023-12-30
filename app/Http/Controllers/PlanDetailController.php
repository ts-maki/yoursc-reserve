<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanDetailController extends Controller
{

    public function show($plan_id)
    {
        $plan = Plan::findOrFail($plan_id);
        return view('plan.show')->with('plan', $plan);

    }


    public function index($plan_id)
    {
        
        $events = [
            [
                'title' => 'イベント 1',
                'start' => '2023-12-30'
            ],
            [
                'title' => 'イベント 2',
                'start' => '2023-12-31'
            ]
        ];

        // return view('plan.show')->with('plan_id', $plan_id);
        return response()->json($events);
    }
}
