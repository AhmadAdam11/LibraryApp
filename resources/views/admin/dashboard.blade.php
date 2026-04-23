@extends('layouts.admin')

@section('content')

<div class="p-5 max-w-5xl mx-auto">

    <div class="mb-5">
        <h1 class="text-lg font-medium">Admin Dashboard</h1>
        <p class="text-sm text-gray-500 mt-0.5">
            Welcome, <span class="font-medium text-gray-700">{{ auth()->user()->name }}</span>
        </p>
    </div>

    {{-- CARDS --}}
    <div class="grid grid-cols-4 gap-2.5 mb-5">
        <div class="bg-white border border-gray-100 rounded-lg p-3">
            <p class="text-[11px] uppercase tracking-wide text-gray-400">Total User</p>
            <h2 class="text-[22px] font-medium mt-1">{{ $totalUser }}</h2>
        </div>
        <div class="bg-white border border-gray-100 rounded-lg p-3">
            <p class="text-[11px] uppercase tracking-wide text-gray-400">User Active</p>
            <h2 class="text-[22px] font-medium text-green-600 mt-1">{{ $userActive }}</h2>
        </div>
        <div class="bg-white border border-gray-100 rounded-lg p-3">
            <p class="text-[11px] uppercase tracking-wide text-gray-400">User Non Active</p>
            <h2 class="text-[22px] font-medium text-red-500 mt-1">{{ $userNonActive }}</h2>
        </div>
        <div class="bg-white border border-gray-100 rounded-lg p-3">
            <p class="text-[11px] uppercase tracking-wide text-gray-400">Total Books</p>
            <h2 class="text-[22px] font-medium text-blue-600 mt-1">{{ $totalBook }}</h2>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-2.5 mb-5">
        <div class="bg-white border border-gray-100 rounded-lg p-3">
            <p class="text-[11px] uppercase tracking-wide text-gray-400">Borrowed Book</p>
            <h2 class="text-[22px] font-medium text-orange-600 mt-1">{{ $bookBorrowed }}</h2>
        </div>
        <div class="bg-white border border-gray-100 rounded-lg p-3">
            <p class="text-[11px] uppercase tracking-wide text-gray-400">Available Book</p>
            <h2 class="text-[22px] font-medium text-teal-600 mt-1">{{ $bookAvailable }}</h2>
        </div>
    </div>

    {{-- CHARTS --}}
    <div class="grid grid-cols-2 gap-2.5">
        <div class="bg-white border border-gray-100 rounded-lg p-4">
            <h2 class="text-[13px] font-medium text-gray-500 mb-3">User Statistics</h2>
            <canvas id="userChart" style="max-height:180px"></canvas>
        </div>
        <div class="bg-white border border-gray-100 rounded-lg p-4">
            <h2 class="text-[13px] font-medium text-gray-500 mb-3">Book Status</h2>
            <canvas id="bookChart" style="max-height:180px"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const userData = @json($userChart);
    const bookData = @json($bookChart);
    const colors = ['#480b46', '#346315'];
    const bookColors = ['#ea580c', '#0d9488'];

    new Chart(document.getElementById('userChart'), {
        type: 'bar',
        data: {
            labels: Object.keys(userData),
            datasets: [{
                label: 'Jumlah User',
                data: Object.values(userData),
                backgroundColor: colors,
                borderRadius: 4,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11 } } },
                y: { grid: { color: 'rgba(0,0,0,0.05)' }, ticks: { font: { size: 11 } } }
            }
        }
    });

    new Chart(document.getElementById('bookChart'), {
        type: 'bar',
        data: {
            labels: Object.keys(bookData),
            datasets: [{
                label: 'Status Buku',
                data: Object.values(bookData),
                backgroundColor: bookColors,
                borderRadius: 4,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11 } } },
                y: { grid: { color: 'rgba(0,0,0,0.05)' }, ticks: { font: { size: 11 } } }
            }
        }
    });
</script>

@endsection