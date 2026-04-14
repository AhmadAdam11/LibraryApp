@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-semibold text-gray-800">User List</h1>

        <a href="{{ route('admin.users.create') }}"
        class="bg-gray-900 hover:bg-gray-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            + Add User
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 text-sm px-4 py-3 rounded-lg mb-5">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="/admin/users" class="flex gap-2 mb-5">
        <input
            type="text"
            name="search"
            placeholder="Search name..."
            value="{{ request('search') }}"
            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-300 transition"
        >

        <select name="status"
                class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300 transition bg-white">
            <option value="">All</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="non-active" {{ request('status') == 'non-active' ? 'selected' : '' }}>Non Active</option>
        </select>

        <button type="submit"
                class="bg-gray-900 hover:bg-gray-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition whitespace-nowrap">
            Search
        </button>
    </form>

    <div class="border border-gray-200 rounded-xl overflow-hidden">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200 bg-gray-50">
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Name</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">NISN</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-4 py-3 font-medium text-gray-800">{{ $user->name }}</td>
                    <td class="px-4 py-3 text-gray-800">{{ $user->email }}</td>
                    <td class="px-4 py-3 text-gray-800">{{ $user->nisn }}</td>

                    <td class="px-4 py-3">
                        @if($user->status === 'active')
                            <span class="inline-block text-xs px-2 py-1 rounded-full bg-green-50 text-green-800 border border-green-200">
                                Active
                            </span>
                        @else
                            <span class="inline-block text-xs px-2 py-1 rounded-full bg-red-50 text-red-800 border border-red-200">
                                Non Active
                            </span>
                        @endif
                    </td>

                    <td class="px-4 py-3 text-center">
                        @if($user->status === 'non-active')
                            <form action="/admin/users/{{ $user->id }}/activate" method="POST"
                                  onsubmit="return confirm('Activate this user?')" class="inline">
                                @csrf
                                <button type="submit"
                                        class="text-xs font-medium px-3 py-1.5 rounded-lg border border-green-200 text-green-600 hover:bg-green-50 transition">
                                    Activate
                                </button>
                            </form>
                        @else
                            <form action="/admin/users/{{ $user->id }}/deactivate" method="POST"
                                  onsubmit="return confirm('Deactivate this user?')" class="inline">
                                @csrf
                                <button type="submit"
                                        class="text-xs font-medium px-3 py-1.5 rounded-lg border border-red-200 text-red-500 hover:bg-red-50 transition">
                                    Deactivate
                                </button>
                            </form>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-10 text-gray-400 text-sm">
                        No users found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection