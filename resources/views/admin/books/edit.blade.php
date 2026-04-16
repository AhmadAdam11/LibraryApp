@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto p-4">

    <h1 class="text-xl font-semibold mb-4 text-gray-800">Edit Book</h1>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-lg mb-4 text-sm">
            <ul class="list-disc pl-4 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data" 
          class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 space-y-3">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1.5 text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" value="{{ $book->title }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block mb-1.5 text-sm font-medium text-gray-700">Author</label>
                <input type="text" name="author" value="{{ $book->author }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <div>
                <label class="block mb-1.5 text-sm font-medium text-gray-700">Publisher</label>
                <input type="text" name="publisher" value="{{ $book->publisher }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block mb-1.5 text-sm font-medium text-gray-700">Publish Year</label>
                <input type="number" name="publish_year" value="{{ $book->publish_year }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>
            <div>
                <label class="block mb-1.5 text-sm font-medium text-gray-700">Description</label>
                <input type="text" name="description" value="{{ $book->description }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <div>
                <label class="block mb-1.5 text-sm font-medium text-gray-700">Category</label>
                <select name="category_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $book->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block mb-1.5 text-sm font-medium text-gray-700">Current Cover</label>
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
                @if($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" 
                         class="w-24 h-32 object-cover rounded-lg shadow-sm border border-gray-200">
                @else
                    <p class="text-sm text-gray-500 italic">No cover image</p>
                @endif
            </div>
        </div>

        <div>
            <label class="block mb-1.5 text-sm font-medium text-gray-700">
                Change Cover <span class="text-gray-400 font-normal">(optional)</span>
            </label>
            <input type="file" name="cover"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm bg-white file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
            <p class="text-xs text-gray-500 mt-1">Leave empty to keep current cover</p>
        </div>

        <div class="flex justify-end gap-2 pt-3 border-t border-gray-100 mt-4">
            <a href="{{ route('books.index') }}" 
               class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                Cancel
            </a>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition shadow-sm">
                Update Book
            </button>
        </div>

    </form>
</div>
@endsection