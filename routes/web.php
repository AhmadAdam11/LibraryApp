<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdmin\SuperDashboardController;
use App\Http\Controllers\SuperAdmin\AdminManagementController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\User\HomePageController;
use App\Http\Controllers\User\DetailBookController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\LoanController as UserLoanController;
use App\Http\Controllers\Admin\LoanController as AdminLoanController;
use App\Http\Controllers\FavoriteController;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/register', [AuthController::class, 'showRegister']);
// Route::post('/register', [AuthController::class, 'register']);
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
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])
        ->name('admin.dashboard');

    // User Management
    Route::get('/users', [UserManagementController::class, 'index'])
        ->name('admin.users.index');

    Route::get('/users/create', [UserManagementController::class, 'create'])
        ->name('admin.users.create');

    Route::post('/users', [UserManagementController::class, 'store'])
        ->name('admin.users.store');

    Route::post('/users/{id}/activate', [UserManagementController::class, 'activate'])
        ->name('admin.users.activate');

    Route::post('/users/{id}/deactivate', [UserManagementController::class, 'deactivate'])
        ->name('admin.users.deactivate');

    // Books
    Route::resource('books', BookController::class);
    Route::post('/books/{id}/add-stock', [BookController::class, 'addStock'])
        ->name('books.addStock');

    // Categories
    Route::resource('categories', CategoryController::class);
    Route::get('/loans', [AdminLoanController::class, 'index'])
        ->name('admin.loans');

    Route::post('/loans/{id}/approve', [AdminLoanController::class, 'approve'])
        ->name('admin.loans.approve');
    Route::post('/loans/{id}/reject', [AdminLoanController::class, 'reject'])
    ->name('admin.loans.reject');
    Route::post('/admin/loans/{id}/approve-return', [AdminLoanController::class, 'approveReturn'])->name('admin.loans.approveReturn');
    Route::post('/admin/loans/{id}/reject-return', [AdminLoanController::class, 'rejectReturn'])->name('admin.loans.rejectReturn');
    Route::get('/admin/loans/export', [AdminLoanController::class, 'export'])->name('loans.export');
});



//users
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/home', [HomePageController::class, 'index'])->name('user.home');
    Route::get('/user/books/{id}', [DetailBookController::class, 'show'])->name('user.books.show');
    Route::get('/loans/create/{bookId}', [UserLoanController::class, 'create'])->name('loans.create');
    Route::post('/loans', [UserLoanController::class, 'store'])->name('loans.store');
    Route::get('/my-loans', [UserLoanController::class, 'index'])->name('user.loans');
    Route::get('/user/loans/{id}/return', [UserLoanController::class, 'returnForm'])->name('user.loans.return.form');
    Route::post('/user/loans/{id}/return', [UserLoanController::class, 'submitReturn'])->name('user.loans.return.submit');
    Route::get('/my-favorite', [FavoriteController::class,'index'])->name('user.favorite');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('user.profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('user.profile.update');
});

Route::post('/favorites/{bookId}', [FavoriteController::class, 'toggle'])
    ->name('favorites.toggle')
    ->middleware('auth');