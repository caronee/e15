<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Book; # Make our Book Model accessible
use Carbon\Carbon; # We’ll use this library to generate timestamps
use Faker\Factory; # We’ll use this library to generate random/fake data
use App\Models\Author;

class BooksTableSeeder extends Seeder
{
    /**
     * This run method is the first method you should have in all your Seeder class files
     * This method will be invoked when we invoke this seeder
     * In this method you should put code that will cause data to be entered into your tables
     * (in this case, that's the `books` table)
     */
    public function run()
    {
        # Three different examples of how to add books
        $this->addOneBook();
        $this->addAllBooksFromBooksDotJsonFile();
        $this->addRandomlyGeneratedBooksUsingFaker();
    }

    /**
     *
     */
    private function addOneBook()
    {
        $book = new Book();
        $book->slug = 'the-martian';
        $book->title = 'The Martian';
        $book->author_id = Author::where('last_name', '=', 'Weir')->pluck('id')->first();
       
        $book->published_year = 2011;
        $book->cover_url = 'https://hes-bookmark.s3.amazonaws.com/the-martian.jpg';
        $book->info_url = 'https://en.wikipedia.org/wiki/The_Martian_(Weir_novel)';
        $book->purchase_url = 'https://www.barnesandnoble.com/w/the-martian-andy-weir/1114993828';
        $book->description = 'The Martian is a 2011 science fiction novel written by Andy Weir. It was his debut novel under his own name. It was originally self-published in 2011; Crown Publishing purchased the rights and re-released it in 2014. The story follows an American astronaut, Mark Watney, as he becomes stranded alone on Mars in the year 2035 and must improvise in order to survive.';
        $book->save();
    }

    /**
     *
     */
    private function addAllBooksFromBooksDotJsonFile()
    {
        $bookData = file_get_contents(database_path('books.json'));
        $books = json_decode($bookData, true);
    
        $count = count($books);
        foreach ($books as $slug => $bookData) {
            $book = new Book();


            # First, figure out the id of the author we want to associate with this book

            # Extract just the last name from the book data...
            # F. Scott Fitzgerald => ['F.', 'Scott', 'Fitzgerald'] => 'Fitzgerald'
            $name = explode(' ', $bookData['author']);
            $lastName = array_pop($name);

            # Find that author in the authors table
            $author_id = Author::where('last_name', '=', $lastName)->pluck('id')->first();


            # For the timestamps, we're using a class called Carbon that comes with Laravel
            # and provides many date/time methods.
            # Learn more: https://github.com/briannesbitt/Carbon
            $book->created_at = Carbon::now()->subDays($count)->toDateTimeString();
            $book->updated_at = Carbon::now()->subDays($count)->toDateTimeString();
            $book->slug = $slug;
            $book->title = $bookData['title'];
            $book->author_id = $author_id ;
            ;
            $book->published_year = $bookData['published_year'];
            $book->cover_url = $bookData['cover_url'];
            $book->info_url = $bookData['info_url'];
            $book->purchase_url = $bookData['purchase_url'];
            $book->description = $bookData['description'];

            $book->save();
            $count--;
        }
    }

    /**
     *
     */
    private function addRandomlyGeneratedBooksUsingFaker()
    {
        # For this example, we'll generate random seed data using a package that
        # comes with Laravel called Faker: https://github.com/fzaninotto/Faker
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $book = new Book();


            
            $title = $faker->words(rand(3, 6), true);
            $book->title = Str::title($title);
            $book->slug = Str::slug($title, '-');
            $book->author_id = null;
            $book->published_year = $faker->year;
            $book->cover_url = 'https://hes-bookmark.s3.amazonaws.com/cover-placeholder.png';
            $book->info_url = 'https://en.wikipedia.org/wiki/' . $book->slug;
            $book->purchase_url = 'https://www.barnesandnoble.com/' . $book->slug;
            $book->description = $faker->paragraphs(1, true);

            $book->save();
        }
    }
}