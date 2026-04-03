@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Daftar Buku</h1>

    <a href="{{ route('books.create') }}">Tambah Buku</a>

    <br><br>

    @if(session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Cover</th>
                <th>Judul</th>
                <th>Author</th>
                <th>Kategori</th>
                <th>Tahun</th>
                <th>Aksi</th>
                <!-- <th>Stock</th> -->
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
                <tr>
                    <td>
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" width="60">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->category->name ?? '-' }}</td>
                    <td>{{ $book->publish_year }}</td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}">Edit</a>

                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection