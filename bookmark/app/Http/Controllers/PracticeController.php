<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class PracticeController extends Controller
{
    /**
     * First practice example
     * GET /practice/1
     */
    public function practice1()
    {
        dump('This is the first example.');
    }

    public function practice2()
    {
        # dump(Book::find(3));
        // dump(Book::all()->toArray());
        dump(Book::where('title', 'LIKE', '%Harry Potter%')->first());
    }

    public function practice3()
    {
  
        # Instantiate a new Book Model object
        $book = new Book();

        # Set the properties
        # Note how each property corresponds to a column in the table
        $book->slug = 'the-martian';
        $book->title = 'The Martian';
        $book->author = 'Anthony Weir';
        $book->published_year = 2011;
        $book->cover_url = 'https://hes-bookmark.s3.amazonaws.com/the-martian.jpg';
        $book->info_url = 'https://en.wikipedia.org/wiki/The_Martian_(Weir_novel)';
        $book->purchase_url = 'https://www.barnesandnoble.com/w/the-martian-andy-weir/1114993828';
        $book->description = 'The Martian is a 2011 science fiction novel written by Andy Weir. It was his debut novel under his own name. It was originally self-published in 2011; Crown Publishing purchased the rights and re-released it in 2014. The story follows an American astronaut, Mark Watney, as he becomes stranded alone on Mars in the year 2035 and must improvise in order to survive.';

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $book->save();

        dump('Added: ' . $book->title);
    }

    public function practice4()
    {
        $book = new Book();
        //$books = $book->where('title', 'LIKE', '%Harry Potter%')->get();
        $books = $book->where('title', 'LIKE', '%Harry Potter%')->orWhere('published_year', '>', 1998)->first();


        if ($books->isEmpty()) {
            dump('No matches found');
        } else {
            //dump($book->toArray());


            foreach ($books as $book) {
                dump($book->title);
            }
        }
    }



    public function practice5()
    {
        $book = new Book();
        //$books = $book->where('title', 'LIKE', '%Harry Potter%')->get();
        $books = Book::where('slug', '=', '%martian%')->first();


  
        dump($book);
    
        dump($book->toArray());
    }



    public function practice6()
    {
        # First get a book to update
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();

        if (!$book) {
            dump("Book not found, can not update.");
        } else {
            # Change some properties
            $book->title = 'The Really Great Gatsby';
            $book->published_year = '2025';

            # Save the changes
            $book->save();

            dump('Update complete; check the database to confirm the update worked.');
        }
    }


    public function practice7()
    {
        # First get a book to delete
        $book = Book::where('author', '=', 'F. Scott Fitzgerald')->first();

        if (!$book) {
            dump('Did not delete- Book not found.');
        } else {
            $book->delete();
            dump('Deletion complete; check the database to see if it worked...');
        }
    }


    public function practice8()
    {
        $book = Book::where('author', '=', 'Dr. Seuss')->get();
        $book->delete();
        dump('Book deleted.');
    }

    public function practice9()
    {
        $book = Book::get();
       
        dump($book);
    }


    /**
     * ANY (GET/POST/PUT/DELETE)
     * /practice/{n?}
     * This method accepts all requests to /practice/ and
     * invokes the appropriate method.
     * http://e15bookmark.loc/practice => Shows a listing of all practice routes
     * http://e15bookmark.loc/practice/1 => Invokes practice1
     * http://e15bookmark.loc/practice/5 => Invokes practice5
     * http://e15bookmark.loc/practice/999 => 404 not found
     */
    public function index($n = null)
    {
        $methods = [];

        # Load the requested `practiceN` method
        if (!is_null($n)) {
            $method = 'practice' . $n; # practice1

            # Invoke the requested method if it exists; if not, throw a 404 error
            return (method_exists($this, $method)) ? $this->$method() : abort(404);
        } # If no `n` is specified, show index of all available methods
        else {
            # Build an array of all methods in this class that start with `practice`
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    $methods[] = $method;
                }
            }

            # Load the view and pass it the array of methods
            return view('practice')->with(['methods' => $methods]);
        }
    }
}