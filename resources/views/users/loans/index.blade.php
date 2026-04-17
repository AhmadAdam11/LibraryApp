@extends('layouts.user')

@section('content')
<div class="max-w-5xl mx-auto mt-10">

    <h2 class="text-2xl font-bold text-white mb-6">My Loans</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-gray-900 rounded-2xl border border-gray-700 overflow-hidden">
        <table class="w-full text-left text-white">
            <thead class="bg-gray-800 text-gray-400">
                <tr>
                    <th class="p-4">Book</th>
                    <th class="p-4">Due Date</th>
                    <th class="p-4">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr class="border-t border-gray-700 hover:bg-gray-800 transition">
                        <td class="p-4">
                            {{ $loan->book->title }}
                        </td>
                        <td class="p-4">
                            {{ $loan->due_date }}
                        </td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded text-sm
                                @if($loan->status == 'pending') bg-yellow-500
                                @elseif($loan->status == 'approved') bg-green-500
                                @elseif($loan->status == 'rejected') bg-red-500
                                @elseif($loan->status == 'returned') bg-blue-500
                                @endif
                            ">
                                {{ ucfirst($loan->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-400">
                            No loans yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection