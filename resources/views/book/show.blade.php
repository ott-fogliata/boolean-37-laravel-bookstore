@extends('layouts.app')

@section('content')
<div class="container">
    <!-- lista dei libri del backoffice --> 


    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{ $book->picture }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{ $book->title }}</h5>
            Scritto da 
            @foreach($book->author as $author)
                {{$author->name}} {{$author->surname}}
            @endforeach
            <p class="card-text">{{ $book->abstract }}</p>
            <p class="card-text">{{ $book->price }}</p>
            <p class="card-text"><strong>{{ $book->genere }}</strong></p>
            <p>Categoria: {{ $book->category->name }}</p>
            <a href="#" class="btn btn-primary">Buy</a>
        </div>
    </div>

</div>
@endsection
