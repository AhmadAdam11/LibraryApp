@extends('layouts.admin')

@section('content')

<div class="p-6 max-w-5xl mx-auto">

    <h1 class="text-2xl font-bold mb-2">Admin Dashboard</h1>

    <p class="text-gray-600 mb-6">
        Selamat datang, <span class="font-semibold">{{ auth()->user()->name }}</span>
    </p>

    <div class="grid grid-cols-3 gap-4">
        
        <div class="bg-white shadow rounded p-4">
            <p class="text-sm text-gray-500">Total User</p>
            <h2 class="text-xl font-bold">-</h2>
        </div>

        <div class="bg-white shadow rounded p-4">
            <p class="text-sm text-gray-500">User Active</p>
            <h2 class="text-xl font-bold">-</h2>
        </div>

        <div class="bg-white shadow rounded p-4">
            <p class="text-sm text-gray-500">User Non Active</p>
            <h2 class="text-xl font-bold">-</h2>
        </div>

    </div>


</div>

@endsection