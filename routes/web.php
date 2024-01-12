<?php


use App\Http\Controllers\auths;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Error\ErrorPage;
use App\Http\Controllers\StaffController;

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

Route::get('/', [AdminController::class, 'index'])->name('index');

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

Route::post('/register', [auths::class, 'register'])->name('register');

Route::post('/login', [auths::class, 'login'])->name('login');

Route::post('/logout', [auths::class, 'logout'])->name('logout');

//admin routes
Route::get('/admin/attendance', [AdminController::class, 'admin_attendance'])->middleware(['auth'])->name('admin_attendance');

Route::get('/admin/staff', [AdminController::class, 'admin_staff'])->middleware(['auth'])->name('admin_staff');

Route::get('/admin/notice', [AdminController::class, 'admin_notice'])->middleware(['auth'])->name('admin_notice');

Route::get('/admin/getStaffAttendanceData', [AdminController::class, 'getStaffAttendanceData'])->middleware(['auth'])->name('getStaffAttendanceData');


//staff routes
Route::get('/staff/clockin', [StaffController::class, 'clockin'])->middleware(['staff', 'auth'])->name('clockin');

Route::get('/staff/attendance', [StaffController::class, 'staff_attendance'])->middleware(['staff', 'auth'])->name('staff_attendance');

Route::get('/staff/getAttendanceData', [StaffController::class, 'getAttendanceData'])->middleware(['staff', 'auth'])->name('getAttendanceData');


Route::get('/staff/leave', [StaffController::class, 'staff_leave'])->middleware(['staff', 'auth'])->name('staff_leave');

Route::get('/staff/announcemet', [StaffController::class, 'staff_announcement'])->middleware(['staff', 'auth'])->name('staff_announcement');








Route::get('/error', [ErrorPage::class, 'index'])->name('error');
