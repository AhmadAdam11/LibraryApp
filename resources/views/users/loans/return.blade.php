@extends('layouts.user')

@section('content')
<div class="container mx-auto px-6 py-8">

    <div class="max-w-lg mx-auto">

        {{-- Header --}}
        <div class="mb-5">
            <h1 class="text-base font-medium text-gray-800">Return Book</h1>
            <p class="text-xs text-gray-400 mt-0.5">Submit your review before returning</p>
        </div>

        {{-- Card --}}
        <div class="border border-gray-200 rounded-xl overflow-hidden">

            {{-- Book Info --}}
            <div class="bg-gray-50 border-b border-gray-200 px-5 py-4 flex items-center gap-3">
                @if($loan->book->cover)
                    <img src="{{ asset('storage/' . $loan->book->cover) }}"
                         class="w-10 h-14 object-cover rounded">
                @else
                    <div class="w-10 h-14 rounded bg-gray-200 border border-gray-200 flex-shrink-0"></div>
                @endif
                <div>
                    <p class="font-medium text-gray-800 text-sm">{{ $loan->book->title }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $loan->book->author }}</p>
                    <span class="inline-block mt-1.5 text-xs px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                        Due {{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}
                    </span>
                </div>
            </div>

            {{-- Form --}}
            <form action="{{ route('user.loans.return.submit', $loan->id) }}" method="POST"
                  class="bg-white px-5 py-5 space-y-5">
                @csrf

                {{-- Star Rating --}}
                <div>
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Rating</label>
                    <div class="flex items-center gap-1" id="star-container">
                        @for($i = 1; $i <= 5; $i++)
                        <button type="button" data-value="{{ $i }}"
                                class="star-btn text-gray-200 hover:text-yellow-400 transition"
                                onclick="setRating({{ $i }})">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </button>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="rating-input" required>
                    <p class="text-xs text-gray-400 mt-1.5" id="rating-label">Select a rating</p>
                </div>

                {{-- Review --}}
                <div>
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">
                        Review <span class="normal-case text-gray-300">(optional)</span>
                    </label>
                    <textarea name="review" rows="4"
                              placeholder="Share your thoughts about this book..."
                              class="w-full text-sm border border-gray-200 rounded-lg px-3 py-2.5 text-gray-700 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 resize-none"></textarea>
                </div>

                {{-- Submit --}}
                <div class="pt-1">
                    <button type="submit"
                            class="w-full bg-gray-900 hover:bg-gray-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition">
                        Submit Return
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

<script>
    const labels = ['', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];

    function setRating(value) {
        document.getElementById('rating-input').value = value;
        document.getElementById('rating-label').textContent = labels[value];

        document.querySelectorAll('.star-btn').forEach((btn, i) => {
            btn.classList.toggle('text-yellow-400', i < value);
            btn.classList.toggle('text-gray-200', i >= value);
        });
    }
</script>

@endsection