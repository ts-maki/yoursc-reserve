<?php

use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\PlanEditController;
use App\Http\Controllers\Admin\ReserveSlotController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('top');
})->name('top');
Route::get('/access', function () {
    return view('access');
})->name('access');
Route::get('/room', function () {
    return view('room.index');
})->name('room');
Route::get('/stay', function () {
    return view('stay.index');
})->name('stay');
Route::get('/inquiry', [InquiryController::class, 'create'])->name('inquiry');
Route::post('inquiry/confirm', [InquiryController::class, 'comfilm'])->name('inquiry.comfilm');
Route::post('inquiry', [InquiryController::class, 'store'])->name('inquiry.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin');
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index');
    Route::get('/admin/inquiry', [AdminInquiryController::class, 'index'])->name('admin.inquiry.index');
    Route::put('/admin/inquiry/{id}/{status_id}', [AdminInquiryController::class, 'update']);
    Route::get('admin/inquiry/{id}', [AdminInquiryController::class, 'show'])->name('admin.inquiry.show');
    Route::get('admin/reserve-slot', [ReserveSlotController::class, 'index'])->name('admin.reserve_slot.index');
    Route::get('admin/reserve-slot/create', [ReserveSlotController::class, 'create'])->name('admin.reserve_slot.create');
    Route::post('admin/reserve-slot/create', [ReserveSlotController::class, 'store'])->name('admin.reserve_slot.store');
    Route::get('admin/reserve-slot/edit/{id}', [ReserveSlotController::class, 'edit'])->name('admin.reserve_slot.edit');
    Route::put('admin/reserve-slot/edit/{id}', [ReserveSlotController::class, 'update'])->name('admin.reserve_slot.update');
    Route::delete('admin/reserve-slot/delete/{id}', [ReserveSlotController::class, 'destroy'])->name('admin.reserve_slot.delete');
    //プラン
    Route::get('admin/plan', [PlanController::class, 'index'])->name('admin.plan.index');
    Route::get('admin/plan/create', [PlanController::class, 'create'])->name('admin.plan.create');
    Route::post('admin/plan/create', [PlanController::class, 'store'])->name('admin.plan.store');
    Route::get('admin/plan/edit/{id}', [PlanEditController::class, 'edit'])->name('admin.plan.edit');
    Route::put('admin/plan/edit/{id}', [PlanEditController::class, 'update'])->name('admin.plan.update');
    Route::delete('admin/plan/{plan_id}/delete/image/{image_id}', [PlanEditController::class, 'destroyImage'])->name('admin.plan.image.delete');
});

require __DIR__.'/auth.php';
