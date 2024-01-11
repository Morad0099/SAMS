<?php

use App\Http\Controllers\AdminAPIController;
use App\Http\Controllers\StaffAPIController;
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

Route::post('/add_staff', [AdminAPIController::class, 'add_staff']);

Route::post('/edit_staff', [AdminAPIController::class, 'edit_staff']);

Route::post('/delete/{id}', [AdminAPIController::class, 'delete_staff'])->name('delete_staff');

Route::post('/add_announcement', [AdminAPIController::class, 'add_announcement']);

Route::post('/edit_announcement', [AdminAPIController::class, 'edit_announcement']);

Route::post('/delete_announcement/{id}', [AdminAPIController::class, 'delete_announcement'])->name('delete_announcement');

//staff api routes
Route::post('/add_leave_request', [StaffAPIController::class, 'add_leave_request']);

Route::post('/delete_leave_request/{id}', [StaffAPIController::class, 'delete_leave_request'])->name('delete_leave_request');

Route::post('/clockin', [StaffAPIController::class, 'clockin'])->name('clockin_attendance');

// Route::get('/getAttendanceData', [StaffAPIController::class, 'getAttendanceData'])->name('getAttendanceData');


