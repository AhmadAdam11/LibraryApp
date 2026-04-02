@extends('layouts.admin')

@section('content')

<div class="p-6 max-w-6xl mx-auto">

    <h1 class="text-2xl font-bold mb-4">List User</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="/admin/users" class="flex gap-2 mb-5">
        <input 
            type="text" 
            name="search" 
            placeholder="Cari nama..."
            value="{{ request('search') }}"
            class="border px-3 py-2 rounded w-full"
        >

        <select name="status" class="border px-3 py-2 rounded">
            <option value="">Semua</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="non-active" {{ request('status') == 'non-active' ? 'selected' : '' }}>Non Active</option>
        </select>

        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Search
        </button>
    </form>

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">NISN</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-3">{{ $user->name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3">{{ $user->nisn }}</td>

                    <td class="p-3">
                        @if($user->status === 'active')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                                Active
                            </span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">
                                Non Active
                            </span>
                        @endif
                    </td>

                    <td class="p-3">
                        @if($user->status === 'non-active')
                            <form action="/admin/users/{{ $user->id }}/activate" method="POST" onsubmit="return confirm('Aktifkan user ini?')">
                                @csrf
                                <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                    Activate
                                </button>
                            </form>
                        @else
                            <form action="/admin/users/{{ $user->id }}/deactivate" method="POST" onsubmit="return confirm('Nonaktifkan user ini?')">
                                @csrf
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Deactivate
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection