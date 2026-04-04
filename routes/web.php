<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdmin\SuperDashboardController;
use App\Http\Controllers\SuperAdmin\AdminManagementController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\User\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
// Route::get('/activate/{token}', [AuthController::class, 'activate']);

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


//Admin
Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])
->middleware(['auth', 'role:admin']);

Route::get('/admin/users', [UserManagementController::class, 'index'])
    ->middleware(['auth', 'role:admin']);

Route::post('/admin/users/{id}/activate', [UserManagementController::class, 'activate'])
    ->middleware(['auth', 'role:admin']);

Route::post('/admin/users/{id}/deactivate', [App\Http\Controllers\Admin\UserManagementController::class, 'deactivate'])
    ->middleware(['auth', 'role:admin']);

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('books', BookController::class);
    Route::post('/books/{id}/add-stock', [BookController::class, 'addStock'])->name('books.addStock');
});


Route::post('/test', function () {
    dd('TEMBUS');
});



//users

Route::get('/user/dashboard', [DashboardController::class, 'index'])
->middleware(['auth', 'role:user']);