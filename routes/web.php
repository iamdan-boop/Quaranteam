<?php

use App\Http\Controllers\MySchedulesController;
use App\Http\Controllers\Resident\DashboardResidence;
use App\Http\Controllers\Resident\LoginController;
use App\Http\Controllers\Resident\ProfileController;
use App\Http\Controllers\Resident\RegisterUserController;
use App\Http\Controllers\Resident\AnnouncementController;
use App\Http\Controllers\Resident\BookingController;
use App\Http\Controllers\Resident\ScheduleController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'base.index');

Route::group(['middleware' => ['guest']], function () {
    // login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.save');


    // register
    Route::get('/register', [RegisterUserController::class, 'index'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'store'])->name('register.save');
});


Route::group(['middleware' => ['auth']], function () {

    Route::group([
        'middleware' => 'is_admin',
        'as' => 'admin.',
        'prefix' => 'admin'
    ], function () {
        Route::get('/dashboard', [DashboardResidence::class, 'index'])->name('admin.dashboard');
        Route::resource('/announcements', App\Http\Controllers\Admin\AnnouncementController::class);
        Route::resource('/manage-residents', App\Http\Controllers\Admin\ResidentController::class);
        Route::resource('/manage-appointments', App\Http\Controllers\Admin\AppointmentController::class);
    });

    Route::post('/upload', [UploadController::class, 'store'])->name('upload');

    Route::group([
        'as' => 'resident.',
        'prefix' => 'resident'
    ], function () {
        Route::get('/dashboard', [DashboardResidence::class, 'index'])->name('residence.dashboard');
        Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements');
        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
        Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules');
        Route::post('/schedules/{appointments}', [ScheduleController::class, 'store'])->name('book.schedule');
        Route::get('/schedules/view-booking/{id}', [ScheduleController::class, 'show'])->name('view-booking.schedules');
        Route::get('/schedules/download/{id}', [ScheduleController::class, 'download'])->name('download.schedule');
    });


    Route::get('/my-schedules', [MySchedulesController::class, 'index'])->name('my-schedules');
    Route::delete('/logout', [DashboardResidence::class, 'destroy'])->name('residence.logout');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/picture', [ProfileController::class, 'updateProfile'])->name('profile.photo');
});
