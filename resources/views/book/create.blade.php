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

    <h1>Aggiungi un nuovo libro</h1>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title">
        </div> 


        <div class="form-group">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="category_id">Options</label>
                </div>
                <select class="custom-select" id="category_id" name="category_id">
                    <option selected>Choose...</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" name="author" id="author">
        </div> 

        <div class="form-group">
            <label for="abstract">Abstract</label>
            <input type="text" class="form-control" name="abstract" id="abstract">
        </div> 

        <div class="form-group">
            <label for="picture">Picture</label>
            <input type="text" class="form-control" name="picture" id="picture">
        </div> 


        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" class="form-control" name="price" id="price">
        </div> 

        <h2>Aggiungi i dettagli</h2>

        <div class="form-group">
            <label for="form_factor">Form Factor</label>
            <input type="text" class="form-control" name="form_factor" id="form_factor">
        </div> 

        <div class="form-group">
            <label for="publisher">Publisher</label>
            <input type="text" class="form-control" name="publisher" id="publisher">
        </div> 

        <div class="form-group">
            <label for="publication_year">Publication Year</label>
            <input type="number" step="1" class="form-control" name="publication_year" id="publication_year" max="2021">
        </div> 

        <div class="form-group">
            <label for="available_copies">Available Copies</label>
            <input type="number" step="1" class="form-control" name="available_copies" id="available_copies">
        </div> 

        <button type="submit" class="btn btn-primary">Salva</button>

    </form>



</div>
@endsection
