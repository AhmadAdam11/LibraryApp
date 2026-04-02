<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index(Request $request) {
        $query = \App\Models\User::where('role', 'user');
        
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $users = $query->get();

        return view('admin.users.index', compact('users'));
    }

    public function activate($id) {
    $user = \App\Models\User::findOrFail($id);

    $user->update([
        'status' => 'active'
    ]);

    return back()->with('success', 'User berhasil di-activate');
    }

    public function deactivate($id) {
    $user = \App\Models\User::findOrFail($id);

    $user->update([
        'status' => 'non-active'
    ]);

    return back()->with('success', 'User berhasil di-nonaktifkan');
    }
}