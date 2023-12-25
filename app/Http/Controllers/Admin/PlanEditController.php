<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class PlanEditController extends Controller
{
    public function edit($plan_id)
    {
        $plan = Plan::with('images')->findOrFail($plan_id);
        return view('admin.plan.edit')->with('plan', $plan);
    }

    public function update(Request $request, $plan_id)
    {

        $plan = Plan::findOrFail($plan_id);

        $plan->title = $request->title;
        $plan->description = $request->description;
        $plan->save();

        //既存の画像更新
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $index => $file) {
                $upload_file_name = $file->getClientOriginalName();
                $existed_file = Image::where('id', $index)->first();
                $existed_file_name = str_replace('storage/images/', '', $existed_file->path);
                $file_name = 'storage/images/' . $upload_file_name;

                //差し替えた画像が宿泊プランに既に登録されている場合登録しない
                $is_file_name = Image::where('plan_id', $plan_id)->where('path', $file_name)->exists();
                Log::debug("差し替えファイル名のプランの登録可否", [$is_file_name]);
                if (!$is_file_name) {
                    $path = $file->storeAs('images', $upload_file_name, 'public');
                    $existed_file->path = $file_name;
                    $existed_file->save();
                }
            }
        }

        //宿泊プランの追加画像の登録
        if ($request->hasFile('image_plus')) {
            foreach ($request->file('image_plus') as $file) {
                $upload_file_name = $file->getClientOriginalName();
                $file_path = 'storage/images/' . $upload_file_name;
                $path = $file->storeAs('images', $upload_file_name, 'public');

                //ファイル名が宿泊プランと紐づくものと異なる場合登録
                $is_file_name = Image::where('plan_id', $plan_id)->where('path', $file_path)->exists();
                Log::debug("追加ファイル名のプランの登録可否", [$is_file_name]);
                if (!$is_file_name) {
                    Image::create([
                        'plan_id' => $plan_id,
                        'path' => $file_path,
                    ]);
                }
            }
        }

        return to_route('admin.plan.index');
    }
}
