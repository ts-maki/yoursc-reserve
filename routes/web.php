<?php

use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
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
});

require __DIR__.'/auth.php';
