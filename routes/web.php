<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdmin\SuperDashboardController;
use App\Http\Controllers\SuperAdmin\AdminManagementController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::prefix('super-admin')->middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/dashboard', [SuperDashboardController::class, 'index']);
    Route::get('/admin', [AdminManagementController::class, 'index']);
    Route::get('/admin/create', [AdminManagementController::class, 'create']);
    Route::post('/admin/store', [AdminManagementController::class, 'store']);
    Route::get('/admin/{id}/edit', [AdminManagementController::class, 'edit']);
    Route::post('/admin/{id}/update', [AdminManagementController::class, 'update']);
    Route::post('/admin/{id}/destroy', [AdminManagementController::class, 'delete']);
});

// DUMMY

Route::get('/admin/dashboard', function () {
    return "Dashboard Admin";
})->middleware(['auth', 'role:admin']);

Route::get('/user/dashboard', function () {
    return "Dashboard User";
})->middleware(['auth', 'role:user']);