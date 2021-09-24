<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function bookDetail() {
        // belongsTo dove abbiamo inserito la foreign key
        return $this->belongsTo(BookDetail::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);  // => categories => category_id
    }

    public function author() {
        //return $this->belongsToMany(Author::class, 'book_author');
        return $this->belongsToMany(Author::class);
    }
}
