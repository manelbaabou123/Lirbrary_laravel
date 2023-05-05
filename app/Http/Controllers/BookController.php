<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        // $data = request()->validate([
        //     'title' => 'required',
        //     'author' => 'required',
        // ]);
        // Book::create($data);

        $book = Book::create($this->validateRequest());
        // return redirect('/books/show/' . $book->id);
        return redirect($book->path());
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Book $book)
    {
        // $data = request()->validate([
        //     'title' => 'required',
        //     'author' => 'required',
        // ]);
        // $book->update($data);
                //Refactor
        $book->update($this->validateRequest());
        // return redirect('/books/show/' . $book->id);
        return redirect($book->path());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('/books/index');
    }

    public function validateRequest()
    {
       return request()->validate([
            'title' => 'required',
            'author' => 'required',
        ]);
    }
}
