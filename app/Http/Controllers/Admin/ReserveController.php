<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reserve;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function index()
    {
        //予約一覧を予約日順で取得
        $reserves = Reserve::with('plan', 'reserveSlot.room')->get()->sortBy(function ($reserve) {
            return $reserve->reserveSlot->date;
        });

        return view('admin.reserve.index')->with('reserves', $reserves);
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
        Reserve::destroy($reserve_id);
        
        return to_route('admin.reserve.index');
    }
}
