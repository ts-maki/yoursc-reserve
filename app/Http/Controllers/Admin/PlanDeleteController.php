<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Support\Str;

use App\Models\Plan;
use App\Models\Reserve_slot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PlanDeleteController extends Controller
{
    public function check($plan_id)
    {
        $plan = Plan::with('planReserveSlots.reserveSlot.room',)->findOrFail($plan_id);
        return view('admin.plan.delete')->with('plan', $plan);
    }

    public function destroy($plan_id)
    {
        DB::transaction(function () use ($plan_id) {
            $plan = Plan::findOrFail($plan_id);

            //宿泊プランと予約枠の関連解除
            $plan->planReserveSlot()->detach();

            //宿泊プランに紐づく画像path削除
            $file_paths = $plan->images()->pluck('path');
            $plan->images()->delete();

            //他の宿泊プランで使用されていない画像をディスクから削除
            foreach ($file_paths as $file_path) {
                $is_file = Image::where('path', $file_path)->exists();
                Log::debug("他の宿泊プランで使用されてるか", [$is_file]);
                if (!$is_file) {
                    $file = Str::remove('storage/', $file_path);
                    if (Storage::disk('public')->exists($file)) {
                        Log::debug("ディスクにあり", [$file]);
                        Storage::disk('public')->delete($file);
                    }
                }
            }

            //プランに紐づく予約の予約枠の部屋数を1足す
            $plan->reserves->map(function ($reserve) {
                // dd($reserve->reserve_slot_id);
                $reserve_slot = Reserve_slot::findOrFail($reserve->reserve_slot_id);
                $reserve_slot->number_of_rooms += 1;
                Log::debug('プラン消した際に予約枠の部屋の数を1足す', [$reserve_slot]);
                $reserve_slot->save();
    
                return $reserve;
            });

            //宿泊プランに紐づく予約との関連解除
            $plan->reservePlan()->detach();
  
            $plan->delete();

        });

        return to_route('admin.plan.index');
    }
}
