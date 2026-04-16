@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">


    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Book List</h1>
        <a href="{{ route('books.create') }}"
           class="inline-flex items-center gap-1 bg-gray-900 hover:bg-gray-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            <span class="text-base leading-none">+</span> Add Book
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 text-sm px-4 py-3 rounded-lg mb-5">
            {{ session('success') }}
        </div>
    @endif

    <div class="border border-gray-200 rounded-xl overflow-hidden">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200 bg-gray-50">
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Cover</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Title</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Author</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Category</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Year</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Description</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Stock</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Add Stock</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($books as $book)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-4 py-3">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}"
                                 class="w-10 h-14 object-cover rounded-md">
                        @else
                            <div class="w-10 h-14 rounded-md bg-gray-100 border border-gray-200"></div>
                        @endif
                    </td>

                    <td class="px-4 py-3 font-medium text-gray-800">{{ $book->title }}</td>

                    <td class="px-4 py-3 text-gray-800">{{ $book->author }}</td>

                    <td class="px-4 py-3">
                        @if($book->category)
                            <span class="inline-block text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-800 border border-gray-200">
                                {{ $book->category->name }}
                            </span>
                        @else
                            <span class="text-gray-300">—</span>
                        @endif
                    </td>

                    <td class="px-4 py-3 text-gray-800">{{ $book->publish_year }}</td>

                    <td class="px-4 py-3 text-gray-800 max-w-xs">
                        <div class="max-h-20 overflow-y-auto text-sm leading-5 pr-1">
                            {{ $book->description }}
                        </div>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <span class="inline-flex items-center justify-center min-w-[28px] h-6 px-2 rounded-full bg-gray-100 text-gray-700 text-xs font-medium border border-gray-200">
                            {{ $book->bookUnits()->count() }}
                        </span>
                    </td>


                    <td class="px-4 py-3">
                        <form action="{{ route('books.addStock', $book->id) }}" method="POST"
                              class="flex items-center justify-center gap-2">
                            @csrf
                            <input type="number" name="amount" min="1" required
                                   class="w-14 text-center text-sm border border-gray-200 rounded-lg px-2 py-1.5 focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white text-gray-700">
                            <button type="submit"
                                    class="w-7 h-7 flex items-center justify-center rounded-lg bg-green-50 text-green-600 border border-green-200 hover:bg-green-100 transition font-medium text-base leading-none">
                                +
                            </button>
                        </form>
                    </td>

                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('books.edit', $book->id) }}"
                               class="text-xs font-medium px-3 py-1.5 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-100 transition">
                                Edit
                            </a>

                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this book?')"
                                        class="text-xs font-medium px-3 py-1.5 rounded-lg border border-red-200 text-red-800 hover:bg-red-50 transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-10 text-gray-400 text-sm">
                        No books available
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection