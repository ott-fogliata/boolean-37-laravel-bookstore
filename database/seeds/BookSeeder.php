<?php

use App\Book;
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

        $genereList = [
            'thriller',
            'avventura',
            'azione',
            'fantascienza',
            'romanzo',
            'biografia'
        ];

        for($i = 0; $i < 10; $i++) {

            $book = new Book();
            $book->title = $faker->sentence();
            $book->author = $faker->name(); 
            $book->abstract = $faker->paragraph(3);

            $randGenereKey = array_rand($genereList, 1);
            $genere = $genereList[$randGenereKey];
            $book->genere = $genere;

            $randPictureKey = array_rand($pictureList, 1);
            $picture = $pictureList[$randPictureKey];
            $book->picture = $picture;

            $book->price = $faker->randomFloat(2, 5, 50);
            
            $book->save();


        }

        
    }
}
