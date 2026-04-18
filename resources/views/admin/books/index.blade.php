@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">

    <div class="flex items-center justify-between mb-5">
        <h1 class="text-base font-medium text-gray-800">Book List</h1>
        <a href="{{ route('books.create') }}"
           class="inline-flex items-center gap-1 bg-gray-900 hover:bg-gray-700 text-white text-xs font-medium px-4 py-2 rounded-lg transition">
            <span>+</span> Add Book
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 text-xs px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="border border-gray-200 rounded-xl overflow-hidden">
        <table class="min-w-full text-xs" style="table-layout: fixed;">
            <colgroup>
                <col style="width: 52px;">   
                <col style="width: 140px;"> 
                <col style="width: 110px;">  
                <col style="width: 90px;">  
                <col style="width: 52px;">   
                <col style="width: 170px;"> 
                <col style="width: 80px;">  
                <col style="width: 90px;">   
                <col style="width: 100px;">  
            </colgroup>

            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Cover</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Title</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Author</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Category</th>
                    <th class="px-3 py-3 text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Year</th>
                    <th class="px-3 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Description</th>
                    <th class="px-3 py-3 text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Stock</th>
                    <th class="px-3 py-3 text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Add Stock</th>
                    <th class="px-3 py-3 text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($books as $book)
                @php
                    $available = $book->bookUnits->where('status', 'available')->count();
                    $total     = $book->bookUnits->count();
                @endphp
                <tr class="hover:bg-gray-50 transition align-middle">

                    <td class="px-3 py-3">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}"
                                 class="w-8 h-11 object-cover rounded">
                        @else
                            <div class="w-8 h-11 rounded bg-gray-100 border border-gray-200"></div>
                        @endif
                    </td>

                    <td class="px-3 py-3">
                        <span class="font-medium text-gray-800 block truncate" title="{{ $book->title }}">
                            {{ $book->title }}
                        </span>
                    </td>

                    <td class="px-3 py-3">
                        <span class="text-gray-800 block truncate" title="{{ $book->author }}">
                            {{ $book->author }}
                        </span>
                    </td>

                    <td class="px-3 py-3">
                        @if($book->category)
                            <span class="inline-block text-xs px-2 py-0.5 rounded-full bg-gray-100 text-gray-800 border border-gray-200 truncate max-w-full">
                                {{ $book->category->name }}
                            </span>
                        @else
                            <span class="text-gray-800">—</span>
                        @endif
                    </td>

                    <td class="px-3 py-3 text-center text-gray-800">
                        {{ $book->publish_year }}
                    </td>

                    <td class="px-3 py-3">
                        <div class="text-gray-800 leading-5 overflow-y-auto" style="max-height: 56px; font-size: 11px;">
                            {{ $book->description }}
                        </div>
                    </td>

                   
                    <td class="px-3 py-3 text-center">
                        <span class="font-medium {{ $available === 0 ? 'text-red-500' : 'text-green-600' }}">
                            {{ $available }}
                        </span>
                        <span class="text-gray-800">/</span>
                        <span class="text-gray-800">{{ $total }}</span>
                        <p class="text-gray-800 mt-0.5" style="font-size: 10px;">avail / total</p>
                    </td>

                    <td class="px-3 py-3">
                        <form action="{{ route('books.addStock', $book->id) }}" method="POST"
                              class="flex items-center justify-center gap-1.5">
                            @csrf
                            <input type="number" name="amount" min="1" value="1" required
                                   class="w-12 text-center text-xs border border-gray-200 rounded-lg px-2 py-1.5 focus:outline-none focus:ring-2 focus:ring-gray-300 bg-white text-gray-700">
                            <button type="submit"
                                    class="w-6 h-6 flex items-center justify-center rounded-lg bg-green-50 text-green-600 border border-green-200 hover:bg-green-100 transition text-sm font-medium leading-none">
                                +
                            </button>
                        </form>
                    </td>

                    <td class="px-3 py-3">
                        <div class="flex items-center justify-center gap-1.5">
                            <a href="{{ route('books.edit', $book->id) }}"
                               class="text-xs font-medium px-3 py-1.5 rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 transition whitespace-nowrap">
                                Edit
                            </a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this book?')"
                                        class="text-xs font-medium px-3 py-1.5 rounded-lg border border-red-200 text-red-700 hover:bg-red-50 transition whitespace-nowrap">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center py-10 text-gray-400 text-sm">
                        No books available
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection