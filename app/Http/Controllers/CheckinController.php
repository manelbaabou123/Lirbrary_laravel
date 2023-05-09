<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CheckinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Book $book)
    {
        try {
            $book->checkin(auth()->user());
        } catch (\Exception $ex) {
            return response([], 404);
        }
    }
}
