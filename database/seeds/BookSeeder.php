<?php

use App\Book;
use App\BookDetail;
use App\Category;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $pictureList = [
            'https://static.scientificamerican.com/sciam/cache/file/1DDFE633-2B85-468D-B28D05ADAE7D1AD8_source.jpg?w=590&h=800&D80F3D79-4382-49FA-BE4B4D0C62A5C3ED',
            'https://nuvola.corriere.it/files/2012/01/books.jpg',
            'https://www.marketplace.org/wp-content/uploads/2021/01/Books_New-e1611252343470.jpg?fit=2879%2C1619',
            'https://cdn.vox-cdn.com/thumbor/9R-2KAfDhXsVGC3YJ_WCSfdb53g=/1400x1050/filters:format(jpeg)/cdn.vox-cdn.com/uploads/chorus_asset/file/21959422/jbareham_201014_1047_scifi_books_essentials_02.jpg',
            'https://i.guim.co.uk/img/media/bddbf0ae13e4b0e4dc91e4cf67224228fb06e7b5/611_15_4317_2590/master/4317.jpg?width=445&quality=45&auto=format&fit=max&dpr=2&s=01250ad8d711dfaec08f0eb1c05db469',
            'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/old-books-arranged-on-shelf-royalty-free-image-1572384534.jpg',
            'https://www.roffeypark.ac.uk/wp-content/uploads/2018/06/the-7-best-books-to-improve-influencing-skills-2-scaled.jpg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOQKqCZ2B1uAqyUvO1tj7gtELvPTg5XLMLiMomQghD0WC6fZDwNwyKCiDGiTWQA4665OM&usqp=CAU',
        ];

        $categoryList = [
            'thriller',
            'avventura',
            'azione',
            'fantascienza',
            'romanzo',
            'biografia'
        ];

        
        $listOfCategoryID = [];  // 1, 2, 3, 4, 5, 6

        foreach($categoryList as $category) {
            $categoryObject = new Category();
            $categoryObject->name = $category;
            $categoryObject->save();
            $listOfCategoryID[] = $categoryObject->id;
        }
    


        for($i = 0; $i < 50; $i++) {

            // Prima creo il book detail
            $bookDetail = new BookDetail();
            $bookDetail->form_factor = $faker->words(1, true);
            $bookDetail->publisher = $faker->words(1, true);
            $bookDetail->publication_year = $faker->date('Y');
            $bookDetail->available_copies = $faker->numberBetween(0, 100);
            $bookDetail->save(); // salvo

            // creo il book
            $book = new Book();
            $book->title = $faker->sentence();
            $book->author = $faker->name(); 
            $book->abstract = $faker->paragraph(3);

            $randPictureKey = array_rand($pictureList, 1);
            $picture = $pictureList[$randPictureKey];
            $book->picture = $picture;

            $randCategoryKey = array_rand($listOfCategoryID, 1);
            $categoryID = $listOfCategoryID[$randCategoryKey];
            $book->category_id = $categoryID;

            $book->price = $faker->randomFloat(2, 5, 50);
            
            // inserisco l'id del detail all'interno del campo foreign key
            $book->book_detail_id = $bookDetail->id;

            $book->save();

        }

        
    }
}
