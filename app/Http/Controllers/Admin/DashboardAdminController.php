<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Book;
use App\Models\BookUnit;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $userActive = User::where('status', 'active')->where('role', 'user')->count();
        $userNonActive = User::where('status', 'non-active')->where('role', 'user')->count();

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

        return view('admin.dashboard', compact(
            'totalUser',
            'userActive',
            'userNonActive',
            'totalBook',
            'bookBorrowed',
            'bookAvailable',
            'userChart',
            'bookChart'
        ));
    }
}