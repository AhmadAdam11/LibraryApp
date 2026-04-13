@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Category Detail</h1>
        <a href="{{ route('categories.index') }}"
           class="text-sm text-gray-500 hover:text-gray-700 transition">
            &larr; Back
        </a>
    </div>

    {{-- Detail Card --}}
    <div class="border border-gray-200 rounded-xl bg-white p-6 max-w-lg">
        <div>
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1.5">Name</p>
            <p class="text-sm font-medium text-gray-800">{{ $category->name }}</p>
        </div>
    </div>

</div>
@endsection