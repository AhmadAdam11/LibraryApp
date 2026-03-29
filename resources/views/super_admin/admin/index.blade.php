@extends('layouts.super_admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">List Admin</h1>

<a href="/super-admin/admin/create" 
   class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
   + Tambah Admin
</a>

<div class="bg-white p-4 rounded shadow">
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">No</th>
                <th class="p-2">Nama</th>
                <th class="p-2">Email</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $index => $admin)
            <tr class="border-t">
                <td class="p-2">{{ $index + 1 }}</td>
                <td class="p-2">{{ $admin->name }}</td>
                <td class="p-2">{{ $admin->email }}</td>
                <td class="p-2 space-x-2">
                    
                    <a href="/super-admin/admin/{{ $admin->id }}/edit" 
                       class="bg-yellow-400 px-3 py-1 rounded">
                       Edit
                    </a>

            <form action="/super-admin/admin/{{ $admin->id }}/destroy" 
                method="POST" 
                class="inline"
                onsubmit="return confirm('Yakin mau hapus admin ini?')">
                @csrf
                <button class="bg-red-500 text-white px-3 py-1 rounded">
                    Delete
                </button>
            </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection