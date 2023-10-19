<?php

use App\Http\Controllers\TelemetriLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('telemetri_logs', [TelemetriLogController::class, 'index'])->name('telemetri_logs.index');
Route::get('telemetri_logs/{telemetriLog}', [TelemetriLogController::class, 'show'])->name('telemetri_logs.show');
Route::post('telemetri_logs', [TelemetriLogController::class, 'store'])->name('telemetri_logs.store');
Route::put('telemetri_logs/{telemetriLog}', [TelemetriLogController::class, 'update'])->name('telemetri_logs.update');
Route::delete('telemetri_logs/{telemetriLog}', [TelemetriLogController::class, 'destroy'])->name('telemetri_logs.delete');
