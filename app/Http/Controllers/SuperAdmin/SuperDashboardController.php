<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Book;
use App\Models\BookUnit;

class SuperDashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $userActive = User::where('status', 'active')->where('role', 'user')->count();
        $userNonActive = User::where('status', 'non-active')->where('role', 'user')->count();

        $totalAdmin = User::where('role', 'admin')->count();
        $totalUserRole = User::where('role', 'user')->count();

        $totalBook = Book::count();
        $bookBorrowed = BookUnit::where('status', 'borrowed')->count();
        $bookAvailable = BookUnit::where('status', 'available')->count();

        $userChart = [
            'Active' => $userActive,
            'Non Active' => $userNonActive,
        ];

        $bookChart = [
            'Borrowed' => $bookBorrowed,
            'Available' => $bookAvailable,
        ];

        return view('super_admin.dashboard', compact(
            'totalUser',
            'userActive',
            'userNonActive',
            'totalBook',
            'bookBorrowed',
            'bookAvailable',
            'totalAdmin',
            'totalUserRole',
            'userChart',
            'bookChart'
        ));
    }
}