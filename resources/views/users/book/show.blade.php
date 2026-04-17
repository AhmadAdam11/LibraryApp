@extends('layouts.user')

@section('content')

<div class="min-h-screen bg-gray-50 px-6 py-8">
<div class="max-w-4xl mx-auto space-y-3">

    <div class="bg-white border border-gray-500 rounded-2xl overflow-hidden flex flex-col md:flex-row">

        <div class="w-full md:w-52 flex-shrink-0 bg-gray-100 flex items-center justify-center min-h-56">
            @if($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}" class="w-full h-full object-cover">
            @else
                <div class="flex flex-col items-center gap-2 text-gray-800 p-8">
                    <svg class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span class="text-xs">No Cover</span>
                </div>
            @endif
        </div>

        <div class="flex-1 p-8 flex flex-col gap-4">

            <div>
                <span class="inline-flex items-center gap-1.5 bg-gray-100 text-gray-500 text-xs font-semibold px-3 py-1.5 rounded-full">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    {{ $book->category->name }}
                </span>
            </div>

            <div>
                <h1 class="text-2xl font-bold text-gray-900 leading-tight">{{ $book->title }}</h1>
                <p class="text-sm text-gray-400 mt-1">by <span class="text-gray-600 font-medium">{{ $book->author }}</span></p>
            </div>

            <div class="flex gap-3">
                <div class="flex-1 bg-gray-50 rounded-xl px-4 py-3">
                    <p class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-1">Publisher</p>
                    <p class="text-sm font-semibold text-gray-800">{{ $book->publisher }}</p>
                </div>
                <div class="flex-1 bg-gray-50 rounded-xl px-4 py-3">
                    <p class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-1">Year</p>
                    <p class="text-sm font-semibold text-gray-800">{{ $book->publish_year }}</p>
                </div>
            </div>

            <hr class="border-gray-100">

            <div class="flex flex-wrap gap-2">
                <div class="flex items-center gap-2 border border-gray-500 bg-white rounded-lg px-3.5 py-2 text-sm font-medium text-gray-600">
                    <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                    Total <strong class="text-gray-900 ml-1">{{ $stock['total'] }}</strong>
                </div>
                <div class="flex items-center gap-2 border border-gray-500 bg-white rounded-lg px-3.5 py-2 text-sm font-medium text-gray-600">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    Available <strong class="text-gray-900 ml-1">{{ $stock['available'] }}</strong>
                </div>
                <div class="flex items-center gap-2 border border-gray-500 bg-white rounded-lg px-3.5 py-2 text-sm font-medium text-gray-600">
                    <span class="w-2 h-2 rounded-full bg-gray-200"></span>
                    Borrowed <strong class="text-gray-900 ml-1">{{ $stock['borrowed'] }}</strong>
                </div>
            </div>
            <a href="{{ route('loans.create', $book->id) }}" class="text-gray-800 flex items-center justify-center border border-gray-800">
                Pinjam Buku
            </a>

        </div>
    </div>

    <div class="bg-white border border-gray-500 rounded-2xl px-8 py-6">
        <p class="text-xs font-semibold uppercase tracking-widest text-gray-800 mb-3">Description</p>
        <p class="text-sm text-gray-500 leading-relaxed">
            {{ $book->description ?? 'No description available for this book.' }}
        </p>
    </div>

    <div class="bg-white border border-gray-500 rounded-2xl px-8 py-6">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-sm font-bold text-gray-800">You may also like</h2>
            <span class="text-xs text-gray-800">Based on category</span>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @forelse($recommendations as $item)
                <a href="{{ route('user.books.show', $item->id) }}"
                   class="group border border-gray-500 rounded-xl p-3 hover:border-gray-300 hover:shadow-sm transition-all duration-150">
                    @if($item->cover)
                        <img src="{{ asset('storage/' . $item->cover) }}"
                             class="w-full h-32 object-cover rounded-lg mb-3">
                    @else
                        <div class="w-full h-32 bg-gray-100 flex items-center justify-center rounded-lg mb-3 text-gray-800">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    @endif
                    <p class="text-xs font-semibold text-gray-700 line-clamp-2 leading-snug group-hover:text-gray-900">{{ $item->title }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $item->author }}</p>
                </a>
            @empty
                <div class="col-span-4 py-10 text-center text-gray-800">
                    <p class="text-sm">No recommendations available.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
</div>

@endsection