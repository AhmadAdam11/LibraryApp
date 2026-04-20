<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Book;

class SuperDashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $userActive = User::where('status', 'active')->count();
        $userNonActive = User::where('status', 'non-active')->count();

        $totalAdmin = User::where('role', 'admin')->count();
        $totalUserRole = User::where('role', 'user')->count();

        $totalBook = Book::count();

        $userChart = [
            'Active' => $userActive,
            'Non Active' => $userNonActive,
        ];

        $roleChart = [
            'Admin' => $totalAdmin,
            'User' => $totalUserRole,
        ];

        return view('super_admin.dashboard', compact(
            'totalUser',
            'userActive',
            'userNonActive',
            'totalBook',
            'totalAdmin',
            'totalUserRole',
            'userChart',
            'roleChart'
        ));
    }
}