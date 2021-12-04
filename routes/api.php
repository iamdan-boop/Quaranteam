<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterUserController;
use App\Models\Announcement;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [RegisterUserController::class, 'store']);

Route::post('/login', [LoginController::class, 'store']);


Route::post('/announcements', [AnnouncementController::class, 'store']);
Route::delete('/announcements/{id}', [AnnouncementController::class, 'destroy']);

Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy']);
Route::post('/appointments', [AppointmentController::class, 'store']);



Route::get('/announcement', function (Request $request) {

    $pdf = SnappyPdf::loadView('pdf.my-schedule');
    return $pdf->download('my-schedule.pdf');
});
