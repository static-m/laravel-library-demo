<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

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
            'pages' => 'nullable|integer|min:1'
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

        return redirect(route('books.create'))->with('status', 'Kniha bola pridaná!');
    }

    /**
     * Show the form to create a new book.
     *
     * @return Response
     */
    private function getPublishedDatetime($date, $time) {
        if($date) {
             $dateStr = $date;

             if($time) {
                 $dateStr .= ' ' . $time;
             }

             return date('Y-m-d H:i:s', strtotime($dateStr));
         }

        return null;
    }

    /**
     * List the books
     *
     * @param  Request  $request
     * @return Response
     */
    public function list(Request $request)
    {

        $books = Book::all()->sortBy('name');

        if($request->search) {
            $search = strtolower($request->search);

            $books = $books->filter(function($book) use ($search) {
                 return strpos(strtolower($book), $search);
            });
        }

        return view('books.list', [
            'books' => $books
        ]);
    }

}
