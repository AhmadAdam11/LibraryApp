<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create() {
        return view('admin.category.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')
            ->with('success', "Category successfully added");
    }

    public function show(Category $category) {
        return view('admin.category.show', compact('category'));
    }

    public function edit(Category $category) {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category successfully updated');
    }

    public function destroy(Category $category) {
        if ($category->books()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Category cannot be deleted because it is still in use by the book');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category successfully deleted');
    }
}