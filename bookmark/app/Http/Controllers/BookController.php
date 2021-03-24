namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
public function index()
{
return 'books';
}

public function show($title)
{

$bookFound = false;
return $view('books/show');
}
}