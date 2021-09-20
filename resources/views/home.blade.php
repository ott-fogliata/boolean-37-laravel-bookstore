@extends('layouts.app')

@section('content')
<div class="container">
    <!-- lista dei libri --> 

    <div class="row">


        @foreach($books as $book)
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ $book->picture }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text">{{ $book->abstract }}</p>
                    <p class="card-text">{{ $book->price }}</p>
                    <p class="card-text"><strong>{{ $book->genere }}</strong></p>
                    <a href="#" class="btn btn-primary">Buy</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>

</div>
@endsection
