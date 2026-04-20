<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Book;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $userActive = User::where('status', 'active')->count();
        $userNonActive = User::where('status', 'non-active')->count();

        $totalBook = Book::count();

        $userChart = [
            'Active' => $userActive,
            'Non Active' => $userNonActive,
        ];

        $bookChart = [
            'Total Buku' => $totalBook,
        ];

        return view('admin.dashboard', compact(
            'totalUser',
            'userActive',
            'userNonActive',
            'totalBook',
            'userChart',
            'bookChart'
        ));
    }
}