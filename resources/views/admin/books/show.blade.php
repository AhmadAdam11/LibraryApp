@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">

    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('books.index') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-50 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <h1 class="text-2xl font-semibold text-gray-800">{{ $book->title }}</h1>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden mb-8">
        <div class="p-6 border-b border-gray-200 grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="flex justify-center">
                @if($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" 
                         class="h-48 object-cover rounded-lg shadow-md">
                @else
                    <div class="h-48 w-32 bg-gray-100 border border-gray-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-400 text-sm">No cover</span>
                    </div>
                @endif
            </div>

            <div class="md:col-span-2">
                <div class="grid grid-cols-1 gap-4">
                    
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1">Title</label>
                        <p class="text-gray-800 font-medium">{{ $book->title }}</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1">Author</label>
                        <p class="text-gray-800">{{ $book->author }}</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1">Publisher</label>
                        <p class="text-gray-800">{{ $book->publisher }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1">Publish Year</label>
                            <p class="text-gray-800">{{ $book->publish_year }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1">Category</label>
                            <p class="text-gray-800">
                                @if($book->category)
                                    <span class="inline-block px-2 py-0.5 rounded-full bg-gray-100 text-gray-800 border border-gray-200 text-xs">
                                        {{ $book->category->name }}
                                    </span>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Description --}}
        <div class="p-6 border-t border-gray-200">
            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-2">Description</label>
            <p class="text-gray-700 leading-relaxed text-sm">{{ $book->description ?? 'No description available' }}</p>
        </div>

        {{-- Actions --}}
        <div class="p-6 bg-gray-50 border-t border-gray-200 flex gap-3">
            <a href="{{ route('books.edit', $book->id) }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-gray-800 text-white rounded-lg font-medium hover:bg-gray-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Book
            </a>
        </div>
    </div>

    {{-- Book Units Section --}}
    <div>
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Book Units (Inventory)</h2>
        
        <div class="border border-gray-200 rounded-xl overflow-hidden overflow-x-auto">
            <table class="min-w-full text-xs">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Unit Code</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Created At</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($book->bookUnits as $unit)
                    <tr class="hover:bg-gray-50 transition">
                        
                        {{-- Unit Code --}}
                        <td class="px-4 py-3">
                            <span class="font-medium text-gray-800">{{ $unit->unit_code }}</span>
                        </td>

                        {{-- Status --}}
                        <td class="px-4 py-3">
                            <span class="inline-block text-xs px-2 py-0.5 rounded-full border font-medium
                                @if($unit->status === 'available')
                                    bg-green-50 text-green-700 border-green-200
                                @elseif($unit->status === 'borrowed')
                                    bg-yellow-50 text-yellow-700 border-yellow-200
                                @else
                                    bg-gray-50 text-gray-700 border-gray-200
                                @endif">
                                {{ ucfirst($unit->status) }}
                            </span>
                        </td>

                        {{-- Created At --}}
                        <td class="px-4 py-3 text-gray-600">
                            {{ $unit->created_at->format('d M Y H:i') }}
                        </td>



                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 text-gray-400 text-sm">
                            No book units available
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Summary --}}
        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-1">Available Units</p>
                <p class="text-2xl font-semibold text-green-700">{{ $book->bookUnits->where('status', 'available')->count() }}</p>
            </div>
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-1">Borrowed Units</p>
                <p class="text-2xl font-semibold text-yellow-700">{{ $book->bookUnits->where('status', 'borrowed')->count() }}</p>
            </div>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-1">Total Units</p>
                <p class="text-2xl font-semibold text-blue-700">{{ $book->bookUnits->count() }}</p>
            </div>
        </div>
    </div>

</div>
@endsection
