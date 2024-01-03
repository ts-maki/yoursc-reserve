<?php

use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\PlanController as AdminPlanController;
use App\Http\Controllers\Admin\PlanEditController as AdminPlanEditController;
use App\Http\Controllers\Admin\ReserveSlotController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\Admin\PlanDeleteController as AdminPlanDeleteController;
use App\Http\Controllers\Admin\ReserveController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PlanDetailController;
use App\Http\Controllers\PlanReserveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//宿泊者
Route::get('/', function () {
    return view('top');
})->name('top');
Route::get('/access', function () {
    return view('access.index');
})->name('access.index');


//プラン
Route::get('/plan', [PlanController::class, 'index'])->name('plan.index');
Route::get('/plan/filter', [PlanController::class, 'filterPlansByDate'])->name('plan.filter');

Route::get('/plan/{id}', [PlanDetailController::class, 'show'])->name('plan.show');
Route::get('/plan/{id}/jp-room', [PlanDetailController::class, 'show'])->name('plan.show.jp');
Route::get('/plan/{id}/wes-room', [PlanDetailController::class, 'show'])->name('plan.show.wes');
Route::get('/plan/{id}/mix-room', [PlanDetailController::class, 'show'])->name('plan.show.mix');
Route::get('/plan/{id}/party-room', [PlanDetailController::class, 'show'])->name('plan.show.party');

//宿泊予約
Route::get('/plan/{id}/reserve/{reserve_slot_id}', [PlanReserveController::class, 'create'])->name('reserve.create');
Route::post('/plan/reserve/comfilm', [PlanReserveController::class, 'comfilm'])->name('reserve.comfilm');
Route::post('/plan/reserve', [PlanReserveController::class, 'store'])->name('reserve.store');
Route::get('/plan/reserve/complete', [PlanReserveController::class, 'showComplete'])->name('reserve.complete');

//カレンダーのエンドポイント
Route::get('/events/{id}', [PlanDetailController::class, 'index']);
Route::get('/events/{id}/wes-room', [PlanDetailController::class, 'index']);
Route::get('/events/{id}/jp-room', [PlanDetailController::class, 'index']);
Route::get('/events/{id}/mix-room', [PlanDetailController::class, 'index']);
Route::get('/events/{id}/party-room', [PlanDetailController::class, 'index']);

//お問い合わせ
Route::get('/inquiry', [InquiryController::class, 'create'])->name('inquiry.index');
Route::post('inquiry/confirm', [InquiryController::class, 'comfilm'])->name('inquiry.comfilm');
Route::post('inquiry', [InquiryController::class, 'store'])->name('inquiry.store');

//部屋
Route::get('/room', [RoomController::class, 'index'])->name('room.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//管理者
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index');

    //お問い合わせ
    Route::get('/admin/inquiry', [AdminInquiryController::class, 'index'])->name('admin.inquiry.index');
    Route::put('/admin/inquiry/{id}/{status_id}', [AdminInquiryController::class, 'update']);
    Route::get('admin/inquiry/{id}', [AdminInquiryController::class, 'show'])->name('admin.inquiry.show');

    //予約枠
    Route::get('admin/reserve-slot', [ReserveSlotController::class, 'index'])->name('admin.reserve_slot.index');
    Route::get('admin/reserve-slot/create', [ReserveSlotController::class, 'create'])->name('admin.reserve_slot.create');
    Route::post('admin/reserve-slot/create', [ReserveSlotController::class, 'store'])->name('admin.reserve_slot.store');
    Route::get('admin/reserve-slot/edit/{id}', [ReserveSlotController::class, 'edit'])->name('admin.reserve_slot.edit');
    Route::put('admin/reserve-slot/edit/{id}', [ReserveSlotController::class, 'update'])->name('admin.reserve_slot.update');
    Route::delete('admin/reserve-slot/delete/{id}', [ReserveSlotController::class, 'destroy'])->name('admin.reserve_slot.delete');

    //プラン
    Route::get('admin/plan', [AdminPlanController::class, 'index'])->name('admin.plan.index');
    Route::get('admin/plan/create', [AdminPlanController::class, 'create'])->name('admin.plan.create');
    Route::post('admin/plan/create', [AdminPlanController::class, 'store'])->name('admin.plan.store');
    Route::get('admin/plan/edit/{id}', [AdminPlanEditController::class, 'edit'])->name('admin.plan.edit');
    Route::put('admin/plan/edit/{id}', [AdminPlanEditController::class, 'update'])->name('admin.plan.update');
    Route::delete('admin/plan/delete/image/{image_id}', [AdminPlanEditController::class, 'destroyImage'])->name('admin.plan.image.delete');
    Route::get('admin/plan/delete/{id}', [AdminPlanDeleteController::class, 'check'])->name('admin.plan.check');
    Route::delete('admin/plan/delete/{id}', [AdminPlanDeleteController::class, 'destroy'])->name('admin.plan.delete');

    //予約
    Route::get('admin/reserve', [ReserveController::class, 'index'])->name('admin.reserve.index');
    Route::get('admin/reserve/{reserve_id}', [ReserveController::class, 'show'])->name('admin.reserve.show');
    //reserve/filterだと上のreserve/{reserve_id}が優先される。{}が任意のパラメーターを受け付けるから
    Route::get('admin/reserve/filter/date', [ReserveController::class, 'filterDateByDate'])->name('admin.reserve.filter');
    Route::get('admin/reserve/filter/today', [ReserveController::class, 'filterDateByToday'])->name('admin.reserve.filter.today');
    Route::get('admin/reserve/filter/tomorrow', [ReserveController::class, 'filterDateByTomorrow'])->name('admin.reserve.filter.tomorrow');
    Route::put('admin/reserve/{reserve_id}', [ReserveController::class, 'update'])->name('admin.reserve.update');
    Route::delete('admin/reserve/{reserve_id}', [ReserveController::class, 'destroy'])->name('admin.reserve.delete');

});

require __DIR__.'/auth.php';
