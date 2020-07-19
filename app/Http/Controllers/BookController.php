<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Show the form to create a new book.
     *
     * @return Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a new book.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'isbn' => 'max:255',
            'genre' => 'max:255',
            'published_date' => 'nullable|date',
            'published_time' => 'nullable|date_format:H:i',
            'author_email' => 'nullable|email|max:255',
            'abstract' => 'nullable',
            'pages' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $book = Book::create([
            'name' => $validatedData['name'],
            'isbn' => $validatedData['isbn'],
            'genre' => $validatedData['genre'],
            'abstract' => $validatedData['abstract'],
            'author_email' => $validatedData['author_email'],
            'published_on' => $this->getPublishedDatetime($validatedData['published_date'], $validatedData['published_time']),
            'pages' => $validatedData['pages']
        ]);

        $book->save();

        if(isset($validatedData['image'])) {
            $imageName = $book->id.'.'.$validatedData['image']->extension();
            $request->image->move(public_path('images'), $imageName);

            $book->image = $imageName;
            $book->save();
        }

        return redirect(route('books.create'))->with('status', 'Kniha bola pridaná!');
    }

    /**
     * Show the form to create a new book.
     *
     * @param  string  $date
     * @param  string  $time
     * @return string MySQL formatted datetime string of publication date
     *
     */
    private function getPublishedDatetime(?string $date, ?string $time) : ?string {
        if($date) {
            $dateStr = $date;

            if($time) {
                $dateStr .= ' ' . $time;
            }

            return $this->toMysqlDatetime($dateStr);
        }

        return null;
    }

    /**
     * Converts datetime string into MySQL format
     *
     * @param  string  $dateString
     * @return string MySQL formatted datetime string
     *
     */
    private function toMysqlDatetime(string $dateString) : string {
        return date('Y-m-d H:i:s', strtotime($dateString));
    }

    /**
     * List the books
     *
     * @param  Request  $request
     * @return Response
     */
    public function list(Request $request)
    {

        $books = DB::table('book');

        if($request->search) {
            $books = $books->where('name', 'LIKE', '%'.$request->search.'%');
        }

        if($request->date_from) {
            $books = $books->where('published_on', '>=', $this->toMysqlDatetime($request->date_from));
        }

        if($request->date_to) {
            $books = $books->where('published_on', '<=',  $this->toMysqlDatetime($request->date_to));
        }

        $orderByColumn = 'name';

        if($request->order_by) {
            $orderByColumn = $request->order_by;
        }

        $books = $books->orderBy($orderByColumn)->simplePaginate(2);

        return view('books.list', [
            'books' => $books,
            'query' => [
                'search' => $request->search,
                'date_from' => $request->date_from,
                'date_to' => $request->date_to,
                'order_by' => $request->order_by,
            ]
        ]);
    }
}
