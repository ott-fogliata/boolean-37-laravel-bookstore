@extends('layouts.app')

@section('content')
<div class="container">
    <!-- lista dei libri del backoffice --> 

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Modifica il libro "{{ $book->title }}"</h1>

    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $book->title }}">
        </div> 


        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" name="author" id="author" value="{{ $book->author }}">
        </div> 

        <div class="form-group">
            <label for="abstract">Abstract</label>
            <input type="text" class="form-control" name="abstract" id="abstract" value="{{ $book->abstract }}">
        </div> 

        <div class="form-group">
            <label for="genere">Genere</label>
            <input type="text" class="form-control" name="genere" id="genere" value="{{ $book->genere }}">
        </div> 

        <div class="form-group">
            <label for="picture">Picture</label>
            <input type="text" class="form-control" name="picture" id="picture" value="{{ $book->picture }}">
        </div> 


        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" class="form-control" name="price" id="price" value="{{ $book->price }}">
        </div> 

        <button type="submit" class="btn btn-primary">Salva</button>

    </form>



</div>
@endsection
