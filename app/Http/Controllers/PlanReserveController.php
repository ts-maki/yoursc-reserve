<?php

namespace App\Http\Controllers;

use App\Mail\Reserve\CompleteReserve;
use App\Mail\Reserve\NewReserve;
use App\Models\Plan;
use App\Models\Plan_reserve_slot;
use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PlanReserveController extends Controller
{
    public function create($plan_id, $reserve_slot_id)
    {
        $plan_reserve = Plan_reserve_slot::with('plan.images:plan_id,path')->where('plan_id', $plan_id)->where('reserve_slot_id', $reserve_slot_id)->first();
        return view('reserve.create')->with('plan_reserve', $plan_reserve);
    }

    public function comfilm(Request $request)
    {
        $request->session()->put('plan_reserve', $request->all());

        //予約重複確認変数
        $plan_id = $request->plan_id;
        $slot_id = $request->reserve_slot_id;
        $tel = $request->tel;

        //予約重複確認変数を全て含む予約があるか
        $is_overlap_reserve = Reserve::where('plan_id', $plan_id)->where('reserve_slot_id', $slot_id)->where('telephone_number', $tel)->exists();

        Log::debug('予約確認時重複予約あるか', [$is_overlap_reserve]);

        $plan_reserve = session('plan_reserve');
        return view('reserve.comfilm')->with('plan_reserve', $plan_reserve)
            ->with('is_overlap_reserve', $is_overlap_reserve);
    }

    public function store()
    {
        Log::debug('予約確認時重複予約あるか', [session('is_overlap_reserve')]);

        $session_reserve = session('plan_reserve');
        $reserve = Reserve::create([
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

        $reserve = Reserve::findOrFail($reserve->id);
        Mail::to($reserve->email)->send(new CompleteReserve($reserve));
        Mail::to('reserve-admin@example.com')->send(new NewReserve($reserve));
        Log::debug('セッションあるか', [session('plan_reserve')]);
        session()->forget('plan_reserve');
        Log::debug('セッションあるか', [session('plan_reserve')]);
        return to_route('reserve.complete');
    }

    public function showComplete()
    {
        return view('reserve.complete');
    }
}
