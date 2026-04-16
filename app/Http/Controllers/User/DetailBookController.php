<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;

class DetailBookController extends Controller
{
    public function show($id)
    {
        $book = Book::with('category')->findOrFail($id);

        $totalStock = $book->bookUnits()->count();

        $availableStock = $book->bookUnits()
            ->where('status', 'available')
            ->count();

        $borrowedStock = $book->bookUnits()
            ->where('status', 'borrowed')
            ->count();

        $recommendations = Book::with('category')
            ->where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->latest()
            ->take(4)
            ->get();

        return view('users.book.show', [
            'book' => $book,
            'recommendations' => $recommendations,
            'stock' => [
                'total' => $totalStock,
                'available' => $availableStock,
                'borrowed' => $borrowedStock
            ]
        ]);
    }
}