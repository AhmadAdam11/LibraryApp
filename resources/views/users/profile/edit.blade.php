@extends('layouts.user')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-2xl mx-auto px-6 py-10">

    {{-- Header --}}
    <div class="mb-8">
        <p class="text-xs font-medium uppercase tracking-widest text-gray-400 mb-1">Account Settings</p>
        <h1 class="text-2xl font-semibold text-gray-900">Edit Profile</h1>
        <p class="text-sm text-gray-500 mt-1">Update your account information below</p>
    </div>

    {{-- Error Messages --}}
    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-xl flex gap-3">
            <svg class="w-4 h-4 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 16 16">
                <circle cx="8" cy="8" r="7" stroke-width="1"/><path d="M8 5v3M8 10.5v.5" stroke-linecap="round"/>
            </svg>
            <div>
                <p class="text-sm font-medium text-red-700 mb-1">Please fix the following errors:</p>
                <ul class="text-sm text-red-600 space-y-0.5 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- Edit Form --}}
    <form action="{{ route('user.profile.update') }}" method="POST"
        class="bg-white border border-gray-200 rounded-xl overflow-hidden">
        @csrf

        <div class="p-6 space-y-5">

            {{-- Name --}}
            <div>
                <label for="name" class="block text-xs font-medium uppercase tracking-wider text-gray-400 mb-1.5">Full name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                    class="w-full px-3 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition @error('name') border-red-400 bg-red-50 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-xs font-medium uppercase tracking-wider text-gray-400 mb-1.5">Email address</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="w-full px-3 py-2 text-sm text-gray-900 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-transparent transition @error('email') border-red-400 bg-red-50 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- NISN (Read-only) --}}
            <div>
                <label class="block text-xs font-medium uppercase tracking-wider text-gray-300 mb-1.5">
                    NISN <span class="normal-case font-normal tracking-normal text-gray-300">(read-only)</span>
                </label>
                <input type="text" value="{{ $user->nisn ?? 'N/A' }}" disabled
                    class="w-full px-3 py-2 text-sm text-gray-400 bg-gray-100 border border-gray-150 rounded-lg cursor-not-allowed">
            </div>

            {{-- Info Note --}}
            <div class="flex gap-2.5 p-3.5 bg-gray-50 border border-gray-100 rounded-lg">
                <svg class="w-3.5 h-3.5 text-gray-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 16 16">
                    <circle cx="8" cy="8" r="7" stroke-width="1"/><path d="M8 7v4M8 5v.1" stroke-width="1.2" stroke-linecap="round"/>
                </svg>
                <p class="text-xs text-gray-500 leading-relaxed">
                    Fields like NISN and role cannot be changed. Contact an administrator if you need to update these.
                </p>
            </div>

        </div>

        {{-- Footer Actions --}}
        <div class="flex items-center justify-between px-6 py-4 border-t border-gray-100 bg-white">
            <button type="submit"
                class="inline-flex items-center gap-1.5 px-5 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 16 16">
                    <path d="M3 8.5l3.5 3.5 6.5-7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Save changes
            </button>
            <a href="{{ route('user.profile.show') }}"
                class="inline-flex items-center px-4 py-2 text-sm text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection