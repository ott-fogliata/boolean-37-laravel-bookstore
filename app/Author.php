<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function book() {
        return $this->belongsToMany(Book::class);
    }
}
