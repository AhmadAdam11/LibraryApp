@extends('layouts.user')

@section('title', 'My Profile')

@section('content')
<div class="max-w-2xl mx-auto px-6 py-10">

    {{-- Header --}}
    <div class="mb-8">
        <p class="text-xs font-medium uppercase tracking-widest text-gray-400 mb-1">Account</p>
        <h1 class="text-2xl font-semibold text-gray-900">My Profile</h1>
        <p class="text-sm text-gray-500 mt-1">Manage your account information</p>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 flex items-center gap-2.5 p-3.5 bg-green-50 border border-green-100 rounded-xl">
            <svg class="w-3.5 h-3.5 text-green-600 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 16 16">
                <circle cx="8" cy="8" r="7" stroke-width="1"/><path d="M5 8l2.5 2.5 4-4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="text-sm text-green-700">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Profile Card --}}
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

        {{-- Profile Header --}}
        <div class="flex items-center gap-4 px-6 py-5 border-b border-gray-100">
            <div class="w-13 h-13 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center text-sm font-medium text-gray-700 shrink-0">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
            <div>
                <p class="text-base font-medium text-gray-900">{{ $user->name }}</p>
                <p class="text-sm text-gray-500">
                    @switch($user->role)
                        @case('admin') Administrator @break
                        @case('super_admin') Super Administrator @break
                        @default Student
                    @endswitch
                </p>
            </div>
            <div class="ml-auto">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs
                    @if($user->status === 'active') bg-green-50 text-green-700
                    @elseif($user->status === 'inactive') bg-gray-100 text-gray-500
                    @else bg-amber-50 text-amber-700 @endif">
                    <span class="w-1.5 h-1.5 rounded-full
                        @if($user->status === 'active') bg-green-600
                        @elseif($user->status === 'inactive') bg-gray-400
                        @else bg-amber-500 @endif"></span>
                    {{ ucfirst($user->status) }}
                </span>
            </div>
        </div>

        {{-- Profile Fields --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5 px-6 py-5">

            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400 mb-1">Full name</p>
                <p class="text-sm text-gray-900">{{ $user->name }}</p>
            </div>

            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400 mb-1">Email address</p>
                <p class="text-sm text-gray-900">{{ $user->email }}</p>
            </div>

            @if($user->nisn)
            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400 mb-1">NISN</p>
                <p class="text-sm text-gray-900 tabular-nums">{{ $user->nisn }}</p>
            </div>
            @endif

            <div>
                <p class="text-xs font-medium uppercase tracking-wider text-gray-400 mb-1">Member since</p>
                <p class="text-sm text-gray-900">{{ $user->created_at->format('d M Y') }}</p>
            </div>

        </div>

        {{-- Footer Action --}}
        <div class="flex items-center px-6 py-4 border-t border-gray-100">
            <a href="{{ route('user.profile.edit') }}"
                class="inline-flex items-center gap-1.5 px-5 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 16 16">
                    <path d="M11.5 2.5a1.5 1.5 0 012.12 2.12l-7.5 7.5-2.62.5.5-2.62 7.5-7.5z" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Edit profile
            </a>
        </div>

    </div>
</div>
@endsection