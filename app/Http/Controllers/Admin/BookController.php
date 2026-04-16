<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{  
    public function index() {
    $books = Book::with('category', 'bookUnits')->latest()->get();

    return view('admin.books.index', compact('books'));
    }

    public function create() {
        $categories = Category::all();

        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publish_year' => 'required|digits:4',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'stock' => 'required|integer|min:1',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('books', 'public');
        }

        $book = Book::create($data);

        $stock = $request->stock;

        $bookCode = 'BK' . str_pad($book->id, 3, '0', STR_PAD_LEFT);

        for ($i = 1; $i <= $stock; $i++) {
            \App\Models\BookUnit::create([
                'book_id' => $book->id,
                'unit_code' => $bookCode . '-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'status' => 'available',
            ]);
        }

        return redirect()->route('books.index')->with('success', 'The book has been added successfully');
    }

    public function edit($id) {
        $book = Book::findOrFail($id);
        $categories = Category::all();

        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id) {
        $book = Book::FindOrFail($id);
        
        $request -> validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'publish_year' => 'required|digits:4',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('cover')) {

            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }

            $data['cover'] = $request->file('cover')->store('books', 'public');
        }

            $book->update($data);

            return redirect()->route('books.index')->with('success', 'The book has been updated successfully');
        }

        public function destroy($id)
        {
            $book = Book::findOrFail($id);

            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }

            $book->delete();

            return redirect()->route('books.index')->with('success', 'The book has been successfully deleted');
        }

        public function addStock(Request $request, $id){
            $request -> validate([
                'amount' => 'required|integer|min:1',
            ]);

            $book = Book::findOrFail($id);

            $amount = $request->amount;

            $bookCode = 'BK' . str_pad($book->id, 3, '0', STR_PAD_LEFT);

            $currentUnitCount = $book->bookUnits()->count();

                for ($i = 1; $i <= $amount; $i++) {
                \App\Models\BookUnit::create([
                    'book_id' => $book->id,
                    'unit_code' => $bookCode . '-' . str_pad($currentUnitCount + $i, 2, '0', STR_PAD_LEFT),
                    'status' => 'available',
                ]);
            }


            return back()->with('success', 'Stock berhasil ditambahkan');
        }
    }
    

