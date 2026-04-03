@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Buku</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Judul</label>
            <input type="text" name="title">
        </div>

        <div>
            <label>Author</label>
            <input type="text" name="author">
        </div>

        <div>
            <label>Publisher</label>
            <input type="text" name="publisher">
        </div>

        <div>
            <label>Tahun Terbit</label>
            <input type="number" name="publish_year">
        </div>

        <div>
            <label>Kategori</label>
            <select name="category_id">
                <option value="">-- pilih kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Cover</label>
            <input type="file" name="cover">
        </div>

        <div>
            <label>Jumlah Stok</label>
            <input type="number" name="stock" min="1">
        </div>

        <br>

        <button type="submit">Simpan</button>
    </form>
</div>
@endsection