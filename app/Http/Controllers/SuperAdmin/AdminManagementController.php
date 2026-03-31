<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminManagementController extends Controller
{
    public function create(){
        return view('super_admin.admin.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'status' => 'active',
        ]);

        return redirect('super-admin/admin/create')->with('success', 'admin succesfully added');
    }

    public function index(){
        $admins = User::where('role', 'admin')->get();
        return view('super_admin.admin.index', compact('admins'));
    }

    public function edit($id) {
        $admin = User::findOrFail($id);
        return view('super_admin.admin.edit', compact('admin'));
    }

    public function update(Request $request, $id) {
        $admin = User::findOrFail($id);

        $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect('super-admin/admin')->with('success', 'admin updated');
    }

    public function delete($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect('/super-admin/admin')->with('success', 'Admin deleted');
    }
}
