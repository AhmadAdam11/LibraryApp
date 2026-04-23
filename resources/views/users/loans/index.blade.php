@extends('layouts.user')

@section('content')
<div class="container mx-auto px-6 py-8">

    <div class="flex items-center justify-between mb-5">
        <h1 class="text-base font-medium text-gray-800">My Loans</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 text-xs px-4 py-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="border border-gray-200 rounded-xl overflow-hidden">
        <table class="min-w-full text-xs" style="table-layout: fixed;">
            <colgroup>
                <col style="width: auto;">
                <col style="width: 120px;">
                <col style="width: 110px;">
                <col style="width: 90px;">
                <col style="width: 110px;">
            </colgroup>

            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fine</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fine Reason</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($loans as $loan)
                <tr class="hover:bg-gray-50 transition align-middle">

                    {{-- Book --}}
                    <td class="px-4 py-3">
                        <span class="font-medium text-gray-800 block truncate" title="{{ $loan->book->title }}">
                            {{ $loan->book->title }}
                        </span>
                    </td>

                    {{-- Due Date --}}
                    <td class="px-4 py-3 text-gray-500">
                        {{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}
                    </td>

                    {{-- Status --}}
                    <td class="px-4 py-3">
                        <span class="inline-block text-xs px-2 py-0.5 rounded-full border font-medium
                            @if($loan->status == 'pending') bg-yellow-50 text-yellow-700 border-yellow-200
                            @elseif($loan->status == 'approved') bg-green-50 text-green-700 border-green-200
                            @elseif($loan->status == 'rejected') bg-red-50 text-red-700 border-red-200
                            @elseif($loan->status == 'pending_return') bg-purple-50 text-purple-700 border-purple-200
                            @elseif($loan->status == 'returned') bg-blue-50 text-blue-700 border-blue-200
                            @endif
                        ">
                            {{ str_replace('_', ' ', ucfirst($loan->status)) }}
                        </span>
                    </td>

                    {{-- Fine --}}
                    <td class="px-4 py-3">
                        @if($loan->fine > 0)
                            <span class="text-red-500 font-medium">Rp {{ number_format($loan->fine) }}</span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    {{-- Fine Reason --}}
                    <td class="px-4 py-3">
                        @if($loan->fine_reason)
                            <span class="text-sm text-gray-600">{{ $loan->fine_reason }}</span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    {{-- Action --}}
                    <td class="px-4 py-3 text-center">
                        @if($loan->status == 'approved')
                            <a href="{{ route('user.loans.return.form', $loan->id) }}"
                               class="inline-block text-xs px-3 py-1.5 rounded-lg bg-gray-900 text-white hover:bg-gray-700 transition">
                                Return
                            </a>
                        @elseif($loan->status == 'pending_return')
                            <span class="text-xs text-gray-400">Waiting approval</span>
                        @else
                            <span class="text-gray-300">-</span>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-10 text-gray-400 text-sm">
                        No loans yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection