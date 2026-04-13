<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardAdminController extends Controller
{
    public function index() {

        $totalUser = User::where('role', 'user')->count();

        $userActive = User::where('role', 'user')
            ->where('status', 'active')
            ->count();

        $userNonActive = User::where('role', 'user')
            ->where('status', 'non-active')
            ->count();

        return view("admin.dashboard", compact(
            'totalUser',
            'userActive',
            'userNonActive'
        ));
    }
}