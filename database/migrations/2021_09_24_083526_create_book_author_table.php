<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookAuthorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_book', function (Blueprint $table) {
            $table->id();

            // qui inserisco le due foreing key verso book e verso author

            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books');

            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('authors');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_author');
    }
}
