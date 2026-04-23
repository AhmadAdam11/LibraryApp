<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class HomePageController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->category;
        $search = $request->search;

        $books = Book::with(['category', 'bookUnits'])
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        $categories = Category::all();

        return view('users.homepage', compact('books', 'categories', 'categoryId'));
    }
}