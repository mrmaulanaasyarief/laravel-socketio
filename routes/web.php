<?php

use App\Http\Controllers\CenterPointController;
use App\Http\Controllers\MapController;
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
    return view('welcome');
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
});

require __DIR__.'/auth.php';
