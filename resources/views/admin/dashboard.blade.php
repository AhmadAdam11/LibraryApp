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
            <p class="text-[11px] uppercase tracking-wide text-gray-400">Total Buku</p>
            <h2 class="text-[22px] font-medium text-blue-600 mt-1">{{ $totalBook }}</h2>
        </div>
    </div>

    {{-- CHARTS --}}
    <div class="grid grid-cols-2 gap-2.5">
        <div class="bg-white border border-gray-100 rounded-lg p-4">
            <h2 class="text-[13px] font-medium text-gray-500 mb-3">User Statistics</h2>
            <canvas id="userChart" style="max-height:180px"></canvas>
        </div>
        <div class="bg-white border border-gray-100 rounded-lg p-4">
            <h2 class="text-[13px] font-medium text-gray-500 mb-3">User Distribution</h2>
            <canvas id="userPieChart" style="max-height:180px"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const userData = @json($userChart);
    const colors = ['#16a34a', '#ef4444'];

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

    new Chart(document.getElementById('userPieChart'), {
        type: 'doughnut',
        data: {
            labels: Object.keys(userData),
            datasets: [{ data: Object.values(userData), backgroundColor: colors, borderWidth: 0 }]
        },
        options: {
            responsive: true,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { font: { size: 11 }, boxWidth: 10, padding: 12 }
                }
            }
        }
    });
</script>

@endsection