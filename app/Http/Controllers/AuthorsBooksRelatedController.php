<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorsBooksRelatedController extends Controller
{
    private $service;

    public function __construct(JSONAPIService $service)
    {
         $this->service = $service;
    }
    public function index(Author $author)
    {
        return $this->service->fetchRelated($author, 'books');
    }

}
