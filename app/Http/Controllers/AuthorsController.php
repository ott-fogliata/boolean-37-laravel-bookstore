<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function list(Author $author) {
        return view('author.show_books', compact('author'));
    }
}
