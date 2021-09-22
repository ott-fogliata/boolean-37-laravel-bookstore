<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookDetail extends Model
{
    public function book() {
        // hasOne dove NON abbiamo la foreign key
        return $this->hasOne(Book::class);
    }
}
