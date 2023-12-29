<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Support\Str;

use App\Models\Plan;
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
        $plan = Plan::findOrFail($plan_id);

        //宿泊プランと部屋の関連解除
        $plan->planRoom()->detach();
        
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

        $plan->delete();
        return to_route('admin.plan.index');
    }
}
