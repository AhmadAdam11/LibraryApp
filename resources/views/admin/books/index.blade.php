@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-4">Book List</h1>

    <a href="{{ route('books.create') }}" 
       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
        + Add Book
    </a>

    <br><br>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Cover</th>
                    <th class="p-3 text-left">Title</th>
                    <th class="p-3 text-left">Author</th>
                    <th class="p-3 text-left">Category</th>
                    <th class="p-3 text-left">Year</th>
                    <th class="p-3 text-center">Stock</th>
                    <th class="p-3 text-center">Add</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($books as $book)
                <tr class="border-t hover:bg-gray-50">

                    <td class="p-3">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" 
                                 class="w-14 h-20 object-cover rounded">
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    <td class="p-3 font-semibold">{{ $book->title }}</td>
                    <td class="p-3">{{ $book->author }}</td>
                    <td class="p-3">{{ $book->category->name ?? '-' }}</td>
                    <td class="p-3">{{ $book->publish_year }}</td>

                    <td class="p-3 text-center font-bold">
                        {{ $book->bookUnits()->count() }}
                    </td>

                    <td class="p-3">
                        <form action="{{ route('books.addStock', $book->id) }}" method="POST" class="flex gap-2 justify-center">
                            @csrf
                            <input type="number" name="amount" min="1"
                                   class="w-16 border rounded px-2 py-1 text-center focus:outline-none focus:ring-2 focus:ring-blue-400"
                                   required>
                            <button type="submit"
                                    class="bg-green-500 hover:bg-green-600 text-white px-2 rounded">
                                +
                            </button>
                        </form>
                    </td>

                    <td class="p-3 text-center space-x-2">
                        <a href="{{ route('books.edit', $book->id) }}" 
                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                            Edit
                        </a>

                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Are you sure?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                Delete
                            </button>
                        </form>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center p-4 text-gray-500">
                        No data available
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection