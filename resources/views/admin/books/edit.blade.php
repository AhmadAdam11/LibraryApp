@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Buku</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label>Judul</label>
            <input type="text" name="title" value="{{ $book->title }}">
        </div>

        <div>
            <label>Author</label>
            <input type="text" name="author" value="{{ $book->author }}">
        </div>

        <div>
            <label>Publisher</label>
            <input type="text" name="publisher" value="{{ $book->publisher }}">
        </div>

        <div>
            <label>Tahun Terbit</label>
            <input type="number" name="publish_year" value="{{ $book->publish_year }}">
        </div>

        <div>
            <label>Kategori</label>
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $book->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Cover Baru (optional)</label>
            <input type="file" name="cover">
        </div>

        <div>
            <p>Cover Lama:</p>
            @if($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}" width="80">
            @else
                -
            @endif
        </div>

        <br>

        <button type="submit">Update</button>
    </form>
</div>
@endsection