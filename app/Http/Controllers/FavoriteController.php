<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function toggle($bookId) {
        $userId = auth()->id();
         $existing = Favorite::where('user_id', $userId)
        ->where('book_id', $bookId)
        ->first();

        if ($existing) {
            $existing->delete();
            return back()->with('success', 'Removed from favorites');
        } else {
            Favorite::create([
                'user_id' => $userId,
                'book_id' => $bookId,
            ]);

            return back()->with('success', 'Added to favorites');
        }
    }
    public function index() {
        $favorites = Favorite::with('book')
            ->where('user_id', auth()->id())
            ->get();

        return view('users.favorite.index', compact('favorites'));
    }
}
