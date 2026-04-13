@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Edit Category</h1>
    </div>

    {{-- Error Messages --}}
    @if($errors->any())
        <div class="bg-red-50 text-red-600 border border-red-200 text-sm px-4 py-3 rounded-lg mb-5">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Card --}}
    <div class="border border-gray-200 rounded-xl bg-white p-6 max-w-lg">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block text-xs font-medium text-gray-800 uppercase tracking-wider mb-1.5">
                    Name
                </label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-300 transition"
                       placeholder="Enter category name">
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="bg-gray-900 hover:bg-gray-700 text-white text-sm font-medium px-5 py-2 rounded-lg transition">
                    Update
                </button>
                <a href="{{ route('categories.index') }}"
                   class="text-sm text-gray-500 hover:text-gray-700 transition">
                    Cancel
                </a>
            </div>

        </form>
    </div>

</div>
@endsection