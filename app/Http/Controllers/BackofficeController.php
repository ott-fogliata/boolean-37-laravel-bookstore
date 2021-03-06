<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewBookCreated;
use App\Book;
use App\BookDetail;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
        $authors = Author::all();
        return view('book.create', compact('categories', 'authors'));
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
            'abstract' => 'required',
            'pictureFile' => ['required', 'image'],
            'price' => 'required',
            'authors' => 'required'
        ]);


        $book = new Book();
        $bookDetail = new BookDetail();

        $this->saveItemFromRequest($book, $bookDetail, $request);

        // dopo che ha salvato il nostro item, inviamo una mail.
        Mail::to('info@test.it')->send(new NewBookCreated($book));

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

        $data = $request->all(); // data ?? un array

        $bookDetail->form_factor = $data['form_factor'];
        $bookDetail->publisher = $data['publisher'];
        $bookDetail->publication_year = $data['publication_year'];
        $bookDetail->available_copies = $data['available_copies'];
        $bookDetail->save();

        $book->title = $data['title'];
        $book->abstract = $data['abstract'];

        $picturePath = Storage::put('images', $data['pictureFile']);
        $book->picture = $picturePath;
        
        $book->price = $data['price'];
        $book->book_detail_id = $bookDetail->id;
        $book->category_id = $data['category_id'];
        $book->save();

        // ricordiamoci prima di salvare, cos?? il nostro book otterr?? un ID (dopo la insert)

        if(array_key_exists('authors', $data)) {

            foreach($data['authors'] as $authorId) {
                $book->author()->attach($authorId);
            }

        }

        // alternativa 
        // $book->author()->sync($data['authors']);

    }
}
