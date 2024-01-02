<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Reserve\CancelReserve;
use App\Models\Reserve;
use App\Models\Reserve_slot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReserveController extends Controller
{
    public function index()
    {
        //予約一覧を予約日順で取得
        $reserves = Reserve::with('plan', 'reserveSlot.room')->get()->sortBy(function ($reserve) {
            return $reserve->reserveSlot->date;
        });

        //一番遅い予約日取得
        $last_reserve_id = $reserves->last()->id;
        $last_reserve_date = $reserves->firstWhere('id', $last_reserve_id)->reserveSlot->date;

        return view('admin.reserve.index')
            ->with('reserves', $reserves)
            ->with('last_reserve_date', $last_reserve_date);
    }

    public function show($reserve_id)
    {
        $reserve = Reserve::with('plan', 'reserveSlot.room')->findOrFail($reserve_id);

        return view('admin.reserve.show')->with('reserve', $reserve);
    }

    public function update(Request $request, $reserve_id)
    {
        $reserve = Reserve::findOrFail($reserve_id)->update(['memo' => $request->memo]);

        return back()->with('completed_memo', 'メモの追加が完了しました');
    }

    public function destroy($reserve_id)
    {
        $reserve = Reserve::findOrFail($reserve_id);
        Mail::to($reserve->email)->send(new CancelReserve($reserve));
        $reserve->delete();

        return to_route('admin.reserve.index');
    }

    //検索日付範囲選択に含まれるリレーション先の予約日を持つ予約レコードを取得
    public function filterDateByDate(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $reserves = Reserve::with('plan', 'reserveSlot.room')->get()->filter(function ($reserve) use ($from, $to) {
            $reserve = Reserve_slot::where('id', $reserve->reserve_slot_id);
            $has_reserve = $reserve->whereBetween('date', [$from, $to])->get();
            if (count($has_reserve) > 0) {
                return $reserve;
            }
        });

        return view('admin.reserve.index')
            ->with('from', $from)
            ->with('to', $to)
            ->with('reserves', $reserves);
    }

    public function filterDateByToday()
    {
        $reserves = Reserve::with('plan', 'reserveSlot.room')->get()->filter(function ($reserve) {
            $has_today_reserve = $reserve->reserveSlot->date == date('Y-m-d');
            if ($has_today_reserve) {
                return $reserve;
            } 
        });

        return view('admin.reserve.index')->with('reserves', $reserves);
    }

    public function filterDateByTomorrow()
    {
        $reserves = Reserve::with('plan', 'reserveSlot.room')->get()->filter(function ($reserve) {
            $has_today_reserve = $reserve->reserveSlot->date == date('Y-m-d', strtotime('tomorrow'));
            if ($has_today_reserve) {
                return $reserve;
            } 
        });

        return view('admin.reserve.index')->with('reserves', $reserves);
    }
}
