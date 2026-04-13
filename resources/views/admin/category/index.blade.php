@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-800">Category List</h1>
        <a href="{{ route('categories.create') }}"
           class="inline-flex items-center gap-1 bg-gray-900 hover:bg-gray-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            <span class="text-base leading-none">+</span> Add Category
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 text-sm px-4 py-3 rounded-lg mb-5">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 text-red-600 border border-red-200 text-sm px-4 py-3 rounded-lg mb-5">
            {{ session('error') }}
        </div>
    @endif

    <div class="border border-gray-200 rounded-xl overflow-hidden">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200 bg-gray-50">
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider w-12">No</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Name</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($categories as $index => $category)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-4 py-3 text-gray-800 text-xs">{{ $index + 1 }}</td>

                    <td class="px-4 py-3 font-medium text-gray-800">{{ $category->name }}</td>

                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-2">

                            <a href="{{ route('categories.edit', $category->id) }}"
                               class="text-xs font-medium px-3 py-1.5 rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 transition">
                                Edit
                            </a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Delete this category?')"
                                        class="text-xs font-medium px-3 py-1.5 rounded-lg border border-red-200 text-red-500 hover:bg-red-50 transition">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-10 text-gray-400 text-sm">
                        No categories found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection