<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show() {
        $user = auth()->user();
        return view('users.profile.show', compact('user'));
    }

    public function edit() {
        $user = auth()->user();
        return view('users.profile.edit', compact('user'));
    }

    public function update(Request $request) {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'grade' => 'nullable|string|max:50',
        ]);

        $user->update($validated);

        return redirect()->route('user.profile.show')->with('success', 'Profil berhasil diperbarui');
    }
}
