@extends('layouts.user')

@section('content')

<div class="min-h-screen bg-gray-50 px-6 py-8">
<div class="max-w-4xl mx-auto space-y-3">

    {{-- Hero Card: Cover + Info --}}
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden flex flex-col md:flex-row">

        {{-- Cover --}}
        <div class="w-full md:w-48 flex-shrink-0 bg-gray-100 flex items-center justify-center min-h-56">
            @if($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}" class="w-full h-full object-cover">
            @else
                <div class="flex flex-col items-center gap-2 text-gray-400 p-8">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span class="text-xs">No cover</span>
                </div>
            @endif
        </div>

        {{-- Info --}}
        <div class="flex-1 p-6 flex flex-col gap-4">

            {{-- Category --}}
            <div>
                <span class="inline-flex items-center gap-1.5 bg-gray-100 text-gray-600 text-xs font-medium px-3 py-1.5 rounded-full border border-gray-200">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    {{ $book->category->name }}
                </span>
            </div>

            {{-- Title, Author, Rating --}}
            <div>
                <h1 class="text-xl font-semibold text-gray-900 leading-tight">{{ $book->title }}</h1>
                <p class="text-sm text-gray-500 mt-1">by <span class="text-gray-800 font-medium">{{ $book->author }}</span></p>
                <div class="flex items-center gap-2 mt-2">
                    <span class="text-yellow-400 text-sm tracking-wide">
                        @for($i = 1; $i <= 5; $i++)
                            {{ $i <= floor($book->average_rating) ? '★' : '☆' }}
                        @endfor
                    </span>
                    <span class="text-sm font-medium text-gray-800">{{ $book->average_rating ?? 0 }}</span>
                    <span class="text-sm text-gray-400">({{ $book->total_reviews }} reviews)</span>
                </div>
            </div>

            {{-- Publisher & Year --}}
            <div class="flex gap-3">
                <div class="flex-1 bg-gray-50 rounded-xl px-4 py-3">
                    <p class="text-xs font-medium uppercase tracking-widest text-gray-400 mb-1">Publisher</p>
                    <p class="text-sm font-medium text-gray-800">{{ $book->publisher }}</p>
                </div>
                <div class="flex-1 bg-gray-50 rounded-xl px-4 py-3">
                    <p class="text-xs font-medium uppercase tracking-widest text-gray-400 mb-1">Year</p>
                    <p class="text-sm font-medium text-gray-800">{{ $book->publish_year }}</p>
                </div>
            </div>

            <hr class="border-gray-100">

            {{-- Stock --}}
            <div class="flex flex-wrap gap-2">
                <div class="flex items-center gap-2 border border-gray-200 bg-white rounded-lg px-3.5 py-2 text-sm text-gray-700">
                    <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                    Total <strong class="text-gray-900 ml-1">{{ $stock['total'] }}</strong>
                </div>
                <div class="flex items-center gap-2 border border-gray-200 bg-white rounded-lg px-3.5 py-2 text-sm text-gray-700">
                    <span class="w-2 h-2 rounded-full bg-green-400"></span>
                    Available <strong class="text-gray-900 ml-1">{{ $stock['available'] }}</strong>
                </div>
                <div class="flex items-center gap-2 border border-gray-200 bg-white rounded-lg px-3.5 py-2 text-sm text-gray-700">
                    <span class="w-2 h-2 rounded-full bg-gray-200"></span>
                    Borrowed <strong class="text-gray-900 ml-1">{{ $stock['borrowed'] }}</strong>
                </div>
            </div>


            @auth
            @php
                $isFavorited = auth()->user()
                    ->favorites
                    ->where('book_id', $book->id)
                    ->count();
            @endphp
            @endauth
            <div class="flex gap-2">

    {{-- Favorite Button --}}
    @auth
    <form action="{{ route('favorites.toggle', $book->id) }}" method="POST">
        @csrf
        <button type="submit"
            class="flex items-center justify-center px-4 py-2.5 rounded-xl border text-sm font-medium transition-all
            {{ $isFavorited 
                ? 'bg-red-50 text-red-500 border-red-200 hover:bg-red-100' 
                : 'bg-gray-100 text-gray-700 border-gray-200 hover:bg-gray-200' }}">
            
            {{ $isFavorited ? '💔 Unfavorite' : '❤️ Favorite' }}
        </button>
    </form>
    @endauth

    {{-- Borrow Button --}}
    <a href="{{ route('loans.create', $book->id) }}"
       class="flex-1 flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-xl px-5 py-2.5 transition-colors">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
        Pinjam buku
    </a>

</div>

        </div>
    </div>

    {{-- Description --}}
    <div class="bg-white border border-gray-200 rounded-2xl px-6 py-5">
        <p class="text-xs font-medium uppercase tracking-widest text-gray-400 mb-3">Description</p>
        <p class="text-sm text-gray-700 leading-relaxed">
            {{ $book->description ?? 'No description available for this book.' }}
        </p>
    </div>

    {{-- Reviews --}}
    <div class="bg-white border border-gray-200 rounded-2xl px-6 py-5">
        <h2 class="text-sm font-semibold text-gray-800 mb-4">User reviews</h2>

        @forelse($book->rating as $rating)
            <div class="py-3 border-b border-gray-100 last:border-b-0 last:pb-0">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-sm font-medium text-gray-800">
                        {{ $rating->user->name ?? 'Unknown User' }}
                    </span>
                    <span class="text-xs text-gray-400">
                        {{ $rating->created_at->diffForHumans() }}
                    </span>
                </div>
                <div class="text-yellow-400 text-xs mb-1.5">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= $rating->rating ? '★' : '☆' }}
                    @endfor
                    <span class="text-gray-500 ml-1">{{ $rating->rating }}/5</span>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed">{{ $rating->review }}</p>
            </div>
        @empty
            <p class="text-sm text-gray-400">Belum ada review untuk buku ini.</p>
        @endforelse
    </div>

    {{-- Recommendations --}}
    <div class="bg-white border border-gray-200 rounded-2xl px-6 py-5">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-sm font-semibold text-gray-800">You may also like</h2>
            <span class="text-xs text-gray-400">Based on category</span>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @forelse($recommendations as $item)
                <a href="{{ route('user.books.show', $item->id) }}"
                   class="group border border-gray-200 rounded-xl p-3 hover:border-gray-300 hover:bg-gray-50 transition-all duration-150">
                    @if($item->cover)
                        <img src="{{ asset('storage/' . $item->cover) }}"
                             class="w-full h-28 object-cover rounded-lg mb-3">
                    @else
                        <div class="w-full h-28 bg-gray-100 flex items-center justify-center rounded-lg mb-3 text-gray-400">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    @endif
                    <p class="text-xs font-medium text-gray-800 line-clamp-2 leading-snug group-hover:text-gray-900">{{ $item->title }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $item->author }}</p>
                </a>
            @empty
                <div class="col-span-4 py-8 text-center">
                    <p class="text-sm text-gray-400">No recommendations available.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
</div>

@endsection