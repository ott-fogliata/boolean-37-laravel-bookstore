@extends('layouts.app')

@section('content')
<div class="container">
    <!-- lista dei libri del backoffice --> 

    {{ $dateNow->format('Y-m-d') }}

    @if($isWeekendFlag)
        it's weekend!
    @else 
        it's a work day
    @endif
    <br/>

    <a href="{{ route('books.create') }}" >
        <button type="button" class="btn btn-primary">Add new</button>
    </a>

    <table class="table table-index">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">title</th>
            <th scope="col">author</th>
            <th scope="col">genere</th>
            <th scope="col">picture</th>
            <th scope="col">price</th>
            <th scope="col">actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                        <th scope="row">{{ $book->id }}</th>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->genere }}</td>
                        <td><img class="pic-table" src="{{ $book->picture }}" /></td>
                        <td>{{ $book->price }} €</td>
                        <td>
                            <a href="{{ route('books.show', $book) }}" >
                                <button type="button" class="btn btn-primary">Show</button>
                            </a>

                            <a href="{{ route('books.edit', $book) }}" >
                                <button type="button" class="btn btn-success">Edit</button>
                            </a>

                            <form action="{{ route('books.destroy', $book) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

 
                        </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
