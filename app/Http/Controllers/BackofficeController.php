<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\BookDetail;
use App\Category;
use Carbon\Carbon;

class BackofficeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        $dateNow = Carbon::now();
        $isWeekendFlag = $dateNow->isWeekend();  // true | false

        return view('book.index', compact('books', 'dateNow', 'isWeekendFlag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('book.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'abstract' => 'required',
            'picture' => ['required', 'url'],
            'price' => 'required',
        ]);


        $book = new Book();
        $bookDetail = new BookDetail();

        $this->saveItemFromRequest($book, $bookDetail, $request);
        return redirect()->route('books.show', $book);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        
        $this->saveItemFromRequest($book, $request); // TODO:
        return redirect()->route('books.show', $book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }

    private function saveItemFromRequest(Book $book, BookDetail $bookDetail, Request $request) {

        $data = $request->all(); // data è un array

        $bookDetail->form_factor = $data['form_factor'];
        $bookDetail->publisher = $data['publisher'];
        $bookDetail->publication_year = $data['publication_year'];
        $bookDetail->available_copies = $data['available_copies'];
        $bookDetail->save();

        $book->title = $data['title'];
        $book->author = $data['author'];
        $book->abstract = $data['abstract'];
        $book->picture = $data['picture'];
        $book->price = $data['price'];
        $book->book_detail_id = $bookDetail->id;
        $book->category_id = $data['category_id'];
        $book->save();
    }
}
