@extends('layouts.user')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-10">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex flex-col md:flex-row gap-10">

        <div class="w-full md:w-72 flex-shrink-0">
            @if($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}"
                     class="w-full h-96 object-cover rounded-xl shadow-sm">
            @else
                <div class="w-full h-96 bg-gray-100 flex flex-col items-center justify-center rounded-xl text-gray-400 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span class="text-sm">No Cover Available</span>
                </div>
            @endif
        </div>

        <div class="flex-1 flex flex-col justify-between">
            <div>
                <span class="inline-block bg-indigo-50 text-indigo-600 text-xs font-semibold px-3 py-1 rounded-full mb-3">
                    {{ $book->category->name }}
                </span>

                <h1 class="text-3xl font-bold text-gray-900 mb-2 leading-snug">
                    {{ $book->title }}
                </h1>

                <p class="text-gray-500 text-base mb-6">by <span class="text-gray-700 font-medium">{{ $book->author }}</span></p>

                <div class="grid grid-cols-2 gap-3 text-sm mb-8">
                    <div class="bg-gray-50 rounded-xl px-4 py-3">
                        <p class="text-gray-400 text-xs uppercase tracking-wide mb-1">Publisher</p>
                        <p class="text-gray-800 font-medium">{{ $book->publisher }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl px-4 py-3">
                        <p class="text-gray-400 text-xs uppercase tracking-wide mb-1">Year</p>
                        <p class="text-gray-800 font-medium">{{ $book->publish_year }}</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <div class="flex items-center gap-2 bg-gray-100 text-gray-700 px-4 py-2.5 rounded-xl text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span>Total: <strong>{{ $stock['total'] }}</strong></span>
                </div>
                <div class="flex items-center gap-2 bg-emerald-50 text-emerald-700 px-4 py-2.5 rounded-xl text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Available: <strong>{{ $stock['available'] }}</strong></span>
                </div>
                <div class="flex items-center gap-2 bg-rose-50 text-rose-700 px-4 py-2.5 rounded-xl text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Borrowed: <strong>{{ $stock['borrowed'] }}</strong></span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <h2 class="text-base font-semibold text-gray-900 mb-3 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
            </svg>
            Description
        </h2>
        <p class="text-gray-600 leading-relaxed text-sm">
            {{ $book->description ?? 'No description available for this book.' }}
        </p>
    </div>

    <div class="mt-10">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-base font-semibold text-gray-900">You May Also Like</h2>
            <span class="text-xs text-gray-400">Based on category</span>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
            @forelse($recommendations as $item)
                <a href="{{ route('user.books.show', $item->id) }}"
                   class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 p-3 group">

                    @if($item->cover)
                        <img src="{{ asset('storage/' . $item->cover) }}"
                             class="w-full h-44 object-cover rounded-lg mb-3">
                    @else
                        <div class="w-full h-44 bg-gray-100 flex items-center justify-center rounded-lg mb-3 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    @endif

                    <h3 class="text-sm font-semibold text-gray-800 line-clamp-2 group-hover:text-indigo-600 transition-colors">
                        {{ $item->title }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $item->author }}</p>
                </a>
            @empty
                <div class="col-span-4 text-center py-10 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-2 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm">No recommendations available.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>

@endsection