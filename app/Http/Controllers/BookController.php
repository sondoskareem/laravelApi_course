<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Requests\JSONAPIRequest;
use App\Http\Resources\JSONAPICollection;
use App\Http\Resources\JSONAPIResource;
use App\Services\JSONAPIService;

class BookController extends Controller
{
    protected function resourceMethodsWithoutModels()
    {
        return ['index', 'store', 'show'];
    }
    private $service;

    public function __construct(JSONAPIService $service){
          $this->service = $service;
          $this->authorizeResource(Book::class, 'book');

    }


    public function index()
    {
        return $this->service->fetchResources(Book::class, 'books');
    }

  
    public function store(JSONAPIRequest $request)
    {
        return $this->service->createResource(Book::class, $request->input('data.attributes')  , $request->input('data.relationships'));
    }

    public function show($book)
    {
        return $this->service->fetchResource(Book::class, $book, 'books');
    }

  

    public function update(JSONAPIRequest $request, Book $book)
    {
        return $this->service->updateResource($book, $request->input('data.attributes'), $request->input('data.relationships'));
    }

    public function destroy(Book $book)
    {
        return $this->service->deleteResource($book);
    }
}
