<?php

use App\Events\MessageCreated;
use App\Http\Controllers\CenterPointController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TelemetriLogController;
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
    return view('welcome');
});

Route::get('message/created', function () {
    MessageCreated::dispatch('Lorem ipsum dolor sit amet');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/center-point/data',[CenterPointController::class,'data'])->name('center-point.data');
    Route::resource('/center-point', CenterPointController::class);

    Route::get('/drone-point/data',[CenterPointController::class,'data'])->name('drone-point.data');
    Route::resource('/drone-point', CenterPointController::class);

    Route::get('/map',[MapController::class,'index'])->name('map.index');

    Route::get('/telemetri-log/data',[TelemetriLogController::class,'data'])->name('telemetri-log.data');
});

require __DIR__.'/auth.php';
