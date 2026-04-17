@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-medium text-gray-900">Loan Requests</h2>
        <span class="text-xs bg-gray-100 text-gray-800 border border-gray-200 rounded-full px-3 py-1">
            {{ $loans->where('status', 'pending')->count() }} pending
        </span>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 text-sm px-4 py-3 rounded-xl mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Alert Error --}}
    @if(session('error'))
        <div class="bg-red-50 text-red-700 border border-red-200 text-sm px-4 py-3 rounded-xl mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Table Card --}}
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="px-5 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">User</th>
                    <th class="px-5 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Book</th>
                    <th class="px-5 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Due Date</th>
                    <th class="px-5 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($loans as $loan)
                <tr class="hover:bg-gray-50 transition-colors duration-150">

                    {{-- User --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-800 text-xs font-medium flex items-center justify-center flex-shrink-0">
                                {{ strtoupper(substr($loan->user->name, 0, 2)) }}
                            </div>
                            <span class="font-medium text-gray-800">{{ $loan->user->name }}</span>
                        </div>
                    </td>

                    {{-- Book --}}
                    <td class="px-5 py-4">
                        <div class="font-medium text-gray-800">{{ $loan->book->title }}</div>
                        @if($loan->book->author)
                            <div class="text-xs text-gray-00 mt-0.5">{{ $loan->book->author }}</div>
                        @endif
                    </td>

                    {{-- Due Date --}}
                    <td class="px-5 py-4">
                        @php $isOverdue = \Carbon\Carbon::parse($loan->due_date)->isPast() && $loan->status === 'pending'; @endphp
                        <span class="text-sm {{ $isOverdue ? 'text-red-400 font-medium' : 'text-gray-800' }}">
                            {{ \Carbon\Carbon::parse($loan->due_date)->format('M d, Y') }}
                        </span>
                        @if($isOverdue)
                            <div class="text-xs text-red-400 mt-0.5">Overdue</div>
                        @endif
                    </td>

                    {{-- Status --}}
                    <td class="px-5 py-4">
                        @php
                            $statusStyles = [
                                'pending'  => 'bg-amber-50 text-amber-600 border border-amber-200',
                                'approved' => 'bg-green-50 text-green-600 border border-green-200',
                                'rejected' => 'bg-red-50 text-red-500 border border-red-200',
                            ];
                            $style = $statusStyles[$loan->status] ?? 'bg-gray-100 text-gray-800 border border-gray-200';
                        @endphp
                        <span class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full {{ $style }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                            {{ ucfirst($loan->status) }}
                        </span>
                    </td>

                    {{-- Action --}}
                    <td class="px-5 py-4">
                        @if($loan->status === 'pending')
                            <div class="flex items-center gap-2">

                                {{-- Approve --}}
                                <form action="{{ route('admin.loans.approve', $loan->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="text-xs font-medium px-3 py-1.5 rounded-lg bg-white text-gray-700 border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-colors duration-150">
                                        Approve
                                    </button>
                                </form>

                                {{-- Reject --}}
                                <form action="{{ route('admin.loans.reject', $loan->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="text-xs font-medium px-3 py-1.5 rounded-lg bg-white text-red-400 border border-red-200 hover:bg-red-50 hover:border-red-300 transition-colors duration-150">
                                        Reject
                                    </button>
                                </form>

                            </div>
                        @else
                            <span class="text-xs text-gray-800">Processed</span>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-5 py-10 text-center text-sm text-gray-400">
                        No loan requests found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($loans instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-4">
            {{ $loans->links() }}
        </div>
    @endif

</div>
@endsection