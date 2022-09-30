<?php

namespace App\Http\Controllers;
use App\Book;

use Illuminate\Http\Request;
use App\Http\Resources\JSONAPICollection;
class BooksAuthorsRelatedController extends Controller
{
    public function index(Book $book)
    {
        return $this->service->fetchRelated($book, 'authors');
    }
}
