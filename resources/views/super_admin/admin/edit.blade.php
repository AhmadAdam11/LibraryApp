@extends('layouts.super_admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">Edit Admin</h1>

<div class="bg-white p-6 rounded shadow-md w-full max-w-md">
    <form action="/super-admin/admin/{{ $admin->id }}/update" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nama</label>
            <input type="text" name="name" value="{{ $admin->name }}"
                class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Email</label>
            <input type="email" name="email" value="{{ $admin->email }}"
                class="w-full border px-3 py-2 rounded">
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>
</div>

@endsection