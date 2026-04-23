@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">

    {{-- Header --}}
<div class="flex items-center justify-between mb-6">

    <h2 class="text-base font-medium text-gray-900">Loan & Return Requests</h2>

    <div class="flex items-center gap-3">
        
        {{-- Tombol Download Excel --}}
        <a href="{{ route('loans.export') }}"
           class="text-xs px-3 py-1.5 rounded-lg bg-green-600 text-white hover:bg-green-700 transition">
            Download Excel
        </a>

        {{-- Pending --}}
        <span class="text-xs bg-gray-100 text-gray-600 border border-gray-200 rounded-full px-3 py-1">
            {{ $loans->where('status', 'pending')->count() }} pending
        </span>

    </div>
</div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 text-sm px-4 py-3 rounded-xl mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 text-red-700 border border-red-200 text-sm px-4 py-3 rounded-xl mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
        <table class="w-full text-sm" style="table-layout: fixed;">
            <colgroup>
                <col style="width: 16%">  {{-- User --}}
                <col style="width: 22%">  {{-- Book --}}
                <col style="width: 13%">  {{-- Due Date --}}
                <col style="width: 13%">  {{-- Status --}}
                <col style="width: 24%">  {{-- Action --}}
                <col style="width: 12%">  {{-- Fine --}}
            </colgroup>
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">User</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Book</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Due Date</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Action</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">Fine</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse($loans as $loan)
                <tr class="hover:bg-gray-50 transition-colors">

                    {{-- User --}}
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 shrink-0 rounded-full bg-purple-100 flex items-center justify-center text-xs font-medium text-purple-700">
                                {{ strtoupper(substr($loan->user->name, 0, 2)) }}
                            </div>
                            <span class="text-xs font-medium text-gray-800 truncate">{{ $loan->user->name }}</span>
                        </div>
                    </td>

                    {{-- Book --}}
                    <td class="px-4 py-3">
                        <div class="text-xs font-medium text-gray-800 truncate">{{ $loan->book->title }}</div>
                        <div class="text-xs text-gray-400 truncate mt-0.5">{{ $loan->book->author }}</div>
                    </td>

                    {{-- Due Date --}}
                    <td class="px-4 py-3">
                        @php
                            $isOverdue = \Carbon\Carbon::parse($loan->due_date)->isPast()
                                && in_array($loan->status, ['approved', 'pending_return']);
                        @endphp

                        <div class="text-xs {{ $isOverdue ? 'text-red-600 font-medium' : 'text-gray-700' }}">
                            {{ \Carbon\Carbon::parse($loan->due_date)->format('M d, Y') }}
                        </div>
                        @if($isOverdue)
                            <span class="mt-1 inline-block text-xs bg-red-50 text-red-500 rounded-full px-2 py-0.5">
                                Overdue
                            </span>
                        @endif
                    </td>

                    {{-- Status --}}
                    <td class="px-4 py-3">
                        @php
                            $statusStyles = [
                                'pending'        => 'bg-yellow-50 text-yellow-700 border border-yellow-200',
                                'approved'       => 'bg-green-50 text-green-700 border border-green-200',
                                'rejected'       => 'bg-red-50 text-red-600 border border-red-200',
                                'pending_return' => 'bg-blue-50 text-blue-700 border border-blue-200',
                                'returned'       => 'bg-gray-100 text-gray-600 border border-gray-200',
                            ];
                        @endphp
                        <span class="inline-block text-xs rounded-full px-2.5 py-1 font-medium whitespace-nowrap {{ $statusStyles[$loan->status] ?? '' }}">
                            {{ str_replace('_', ' ', ucfirst($loan->status)) }}
                        </span>
                    </td>

                    {{-- Action --}}
                    <td class="px-4 py-3">
                        @if($loan->status === 'pending')
                            <div class="flex gap-2">
                                <form action="{{ route('admin.loans.approve', $loan->id) }}" method="POST">
                                    @csrf
                                    <button class="text-xs px-3 py-1.5 rounded-lg border border-gray-200 bg-white text-gray-700 hover:bg-gray-50 font-medium transition-colors">
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.loans.reject', $loan->id) }}" method="POST">
                                    @csrf
                                    <button class="text-xs px-3 py-1.5 rounded-lg border border-red-200 bg-white text-red-500 hover:bg-red-50 font-medium transition-colors">
                                        Reject
                                    </button>
                                </form>
                            </div>

                        @elseif($loan->status === 'pending_return')
                            @php
                                $today      = \Carbon\Carbon::now();
                                $due        = \Carbon\Carbon::parse($loan->due_date);
                                $lateDays   = $today->greaterThan($due) ? $due->diffInDays($today) : 0;
                                $defaultFine = $lateDays * 5000;
                            @endphp

                            <div class="flex flex-col gap-2">
                                <form action="{{ route('admin.loans.approveReturn', $loan->id) }}" method="POST">
                                    @csrf
                                    <div class="flex flex-col gap-1.5">
                                        <label class="text-xs text-gray-400 uppercase tracking-wide" style="font-size:9px;">Fine (Rp)</label>
                                        <div class="flex items-center gap-2">
                                            <input type="number" name="fine"
                                                value="{{ $defaultFine }}"
                                                class="w-24 px-2 py-1.5 text-xs border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-gray-300"
                                                min="0">
                                            <button class="text-xs px-3 py-1.5 rounded-lg border border-green-200 bg-white text-green-600 hover:bg-green-50 font-medium transition-colors whitespace-nowrap">
                                                Approve
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <form action="{{ route('admin.loans.rejectReturn', $loan->id) }}" method="POST">
                                    @csrf
                                    <button class="text-xs px-3 py-1.5 rounded-lg border border-red-200 bg-white text-red-500 hover:bg-red-50 font-medium transition-colors">
                                        Reject return
                                    </button>
                                </form>
                            </div>

                        @else
                            <span class="text-xs text-gray-400">—</span>
                        @endif
                    </td>

                    {{-- Fine --}}
                    <td class="px-4 py-3">
                        @if($loan->fine > 0)
                            <span class="text-xs font-medium text-red-500">
                                Rp {{ number_format($loan->fine, 0, ',', '.') }}
                            </span>
                        @else
                            <span class="text-xs text-gray-400">—</span>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-12 text-sm text-gray-400">
                        No data found
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