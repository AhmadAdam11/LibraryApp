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

        $books = Book::with(['category', 'bookUnits'])
            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->get();

        $categories = Category::all();

        return view('users.homepage', compact('books', 'categories', 'categoryId'));
    }
}