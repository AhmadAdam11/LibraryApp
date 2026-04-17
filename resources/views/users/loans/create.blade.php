@extends('layouts.user')

@section('content')
<div class="max-w-xl mx-auto py-10 px-4">

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-xl font-medium text-gray-900">Borrow Book</h2>
        <p class="text-sm text-gray-400 mt-1">Fill in the details to submit your loan request.</p>
    </div>

    {{-- Alert Error --}}
    @if(session('error'))
        <div class="bg-red-50 text-red-600 border border-red-200 text-sm px-4 py-3 rounded-xl mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Card --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6">
        <form action="{{ route('loans.store') }}" method="POST">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">

            {{-- Book Info --}}
            <div class="mb-5">
                <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Book</label>
                <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                    <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">{{ $book->title }}</p>
                        @if($book->author)
                            <p class="text-xs text-gray-400 mt-0.5">{{ $book->author }}</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Due Date --}}
            <div class="mb-6">
                <label class="block text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Due Date</label>
                <input
                    type="date"
                    name="due_date"
                    min="{{ now()->addDay()->format('Y-m-d') }}"
                    class="w-full px-4 py-3 text-sm text-gray-800 bg-white border border-gray-200 rounded-xl focus:outline-none focus:border-gray-400 transition-colors duration-150"
                    required
                >
                @error('due_date')
                    <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Divider --}}
            <div class="border-t border-gray-100 mb-5"></div>

            {{-- Actions --}}
            <div class="flex items-center justify-between">
                <a href="{{ url()->previous() }}"
                    class="text-sm text-gray-400 hover:text-gray-600 transition-colors duration-150">
                    ← Back
                </a>
                <button type="submit"
                    class="text-sm font-medium px-5 py-2 rounded-xl bg-gray-900 text-white hover:bg-gray-700 transition-colors duration-150">
                    Submit Request
                </button>
            </div>

        </form>
    </div>

</div>
@endsection