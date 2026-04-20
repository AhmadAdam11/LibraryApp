@extends('layouts.super_admin')

@section('content')

<div class="p-6 max-w-6xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-xl font-semibold">Super Admin Dashboard</h1>
        <p class="text-sm text-gray-500">
            Selamat datang, 
            <span class="font-medium text-gray-700">{{ auth()->user()->name }}</span>
        </p>
    </div>

    {{-- CARDS --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

        <div class="bg-white border rounded-lg p-4">
            <p class="text-xs text-gray-400">Total User</p>
            <h2 class="text-xl font-semibold mt-1">{{ $totalUser }}</h2>
        </div>

        <div class="bg-white border rounded-lg p-4">
            <p class="text-xs text-gray-400">User Active</p>
            <h2 class="text-xl font-semibold text-green-600 mt-1">{{ $userActive }}</h2>
        </div>

        <div class="bg-white border rounded-lg p-4">
            <p class="text-xs text-gray-400">User Non Active</p>
            <h2 class="text-xl font-semibold text-red-500 mt-1">{{ $userNonActive }}</h2>
        </div>

        <div class="bg-white border rounded-lg p-4">
            <p class="text-xs text-gray-400">Total Buku</p>
            <h2 class="text-xl font-semibold text-blue-600 mt-1">{{ $totalBook }}</h2>
        </div>

        {{-- EXTRA KHUSUS SUPER ADMIN --}}
        <div class="bg-white border rounded-lg p-4">
            <p class="text-xs text-gray-400">Total Admin</p>
            <h2 class="text-xl font-semibold text-purple-600 mt-1">{{ $totalAdmin }}</h2>
        </div>

        <div class="bg-white border rounded-lg p-4">
            <p class="text-xs text-gray-400">Total User Role</p>
            <h2 class="text-xl font-semibold text-orange-500 mt-1">{{ $totalUserRole }}</h2>
        </div>

    </div>

    {{-- CHART --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        {{-- USER STATUS --}}
        <div class="bg-white border rounded-lg p-4">
            <h2 class="text-sm text-gray-500 mb-3">User Status</h2>
            <canvas id="userChart" style="max-height:200px"></canvas>
        </div>

        {{-- ROLE DISTRIBUTION --}}
        <div class="bg-white border rounded-lg p-4">
            <h2 class="text-sm text-gray-500 mb-3">Role Distribution</h2>
            <canvas id="roleChart"></canvas>
        </div>

    </div>

</div>

{{-- CHART JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const userData = @json($userChart);
    const roleData = @json($roleChart);

    // USER STATUS CHART
    new Chart(document.getElementById('userChart'), {
        type: 'bar',
        data: {
            labels: Object.keys(userData),
            datasets: [{
                data: Object.values(userData),
                backgroundColor: ['#16a34a', '#ef4444'],
                borderRadius: 4
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            responsive: true
        }
    });

    // ROLE CHART
    new Chart(document.getElementById('roleChart'), {
        type: 'doughnut',
        data: {
            labels: Object.keys(roleData),
            datasets: [{
                data: Object.values(roleData),
                backgroundColor: ['#7c3aed', '#f97316']
            }]
        },
        options: {
            cutout: '65%',
            responsive: true
        }
    });
</script>

@endsection