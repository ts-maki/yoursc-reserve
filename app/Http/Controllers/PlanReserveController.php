<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Plan_reserve_slot;
use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlanReserveController extends Controller
{
    public function create($plan_id, $reserve_slot_id){
        $plan_reserve = Plan_reserve_slot::with('plan.images:plan_id,path')->where('plan_id', $plan_id)->where('reserve_slot_id', $reserve_slot_id)->first();
        return view('reserve.create')->with('plan_reserve', $plan_reserve);
    }

    public function comfilm(Request $request){
        $request->session()->put('plan_reserve', $request->all());
        
        //画面間でつなっがているのにセッションを使う必要性？
        $plan_reserve = session('plan_reserve');
        return view('reserve.comfilm')->with('plan_reserve', $plan_reserve);
    }

    public function store(){
        $session_reserve = session('plan_reserve');
        Reserve::create([
            'plan_id' =>  $session_reserve['plan_id'],
            'reserve_slot_id' => $session_reserve['reserve_slot_id'],
            'first_name' => $session_reserve['first_name'],
            'last_name' => $session_reserve['last_name'],
            'email' => $session_reserve['email'],
            'address' => $session_reserve['address'],
            'telephone_number' => $session_reserve['tel'],
            'message' => $session_reserve['message'],
            'address' => $session_reserve['address'],
        ]);
        Log::debug('セッションあるか' , [session('plan_reserve')]);

        session()->forget('plan_reserve');
        Log::debug('セッションあるか' , [session('plan_reserve')]);
        return to_route('reserve.complete');
    }

    public function showComplete()
    {
        
    }
}
