<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// DUMMY
Route::get('/super-admin/dashboard', function () {
    return "Dashboard Super Admin";
})->middleware(['auth', 'role:super_admin']);

Route::get('/admin/dashboard', function () {
    return "Dashboard Admin";
})->middleware(['auth', 'role:admin']);

Route::get('/user/dashboard', function () {
    return "Dashboard User";
})->middleware(['auth', 'role:user']);