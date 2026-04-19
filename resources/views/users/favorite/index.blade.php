@extends('layouts.user')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-4xl font-bold text-gray-800">Favorite Books</h2>
        <p class="text-l text-gray-500 mt-0.5">Your saved collection</p>
    </div>
</div>

<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">

    @forelse ($favorites as $fav)

        @php
            $book = $fav->book;
            $stock = $book->bookUnits->where('status', 'available')->count();
        @endphp

        <div class="group bg-gradient-to-b from-gray-900 to-gray-800 rounded-2xl overflow-hidden border border-white/5 
            hover:border-indigo-500/60 hover:shadow-lg hover:shadow-indigo-500/20 
            hover:-translate-y-1 hover:scale-[1.02]
            transition-all duration-300 flex flex-col cursor-pointer">

            <div class="relative overflow-hidden">
                @if($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}"
                        class="w-full object-cover group-hover:scale-105 transition-transform duration-500"
                        style="height: 180px;">
                @else
                    <div class="w-full flex items-center justify-center bg-gradient-to-br from-gray-700 to-gray-800 text-gray-600"
                         style="height: 180px;">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path d="M12 6.25278V19.2528M12 6.25278C10.8321 5.47686 9.24649 5 7.5 5C5.75351 5 4.16789 5.47686 3 6.25278V19.2528C4.16789 18.4769 5.75351 18 7.5 18C9.24649 18 10.8321 18.4769 12 19.2528M12 6.25278C13.1679 5.47686 14.7535 5 16.5 5C18.2465 18 19.8321 18 21 19.2528"/>
                        </svg>
                    </div>
                @endif

                <span class="absolute top-2 left-2 text-[9px] font-bold px-2 py-1 rounded-full
                    {{ $stock > 0 ? 'bg-emerald-500/90 text-white' : 'bg-red-500/80 text-white' }}">
                    {{ $stock > 0 ? 'available' : 'out' }}
                </span>

                <form action="{{ route('favorites.toggle', $book->id) }}" method="POST">
                    @csrf
                    <button class="absolute top-2 right-2 text-red-400 hover:scale-110 transition">
                        ❤️
                    </button>
                </form>
            </div>

            <div class="p-3 flex flex-col flex-1">
                <h3 class="font-bold text-white text-xs leading-snug mb-1 line-clamp-2">
                    {{ $book->title }}
                </h3>

                <p class="text-[10px] text-indigo-400 mb-1">
                    {{ $book->category->name ?? '-' }}
                </p>

                <div class="flex items-center gap-[2px] text-[10px] mb-1">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= floor($book->average_rating))
                            <span class="text-yellow-400">★</span>
                        @else
                            <span class="text-gray-600">☆</span>
                        @endif
                    @endfor
                    <span class="text-gray-500 ml-1">
                        ({{ $book->total_reviews }})
                    </span>
                </div>

                <p class="text-[10px] text-gray-500 mb-3">
                    Stok: 
                    <span class="font-bold {{ $stock > 0 ? 'text-emerald-400' : 'text-red-400' }}">
                        {{ $stock }}
                    </span>
                </p>

                <a href="{{ route('user.books.show', $book->id) }}"
                   class="mt-auto block text-center bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-bold py-1.5 rounded-lg transition-colors duration-200">
                    Detail
                </a>
            </div>

        </div>

    @empty
        <div class="col-span-6 text-center py-24 text-gray-600">
            <p class="text-sm">No favorite books yet</p>
        </div>
    @endforelse

</div>

@endsection