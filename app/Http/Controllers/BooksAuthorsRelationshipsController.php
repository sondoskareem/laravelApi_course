<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\JSONAPIRelationshipRequest;
use App\Services\JSONAPIService;
use App\Book;
class BooksAuthorsRelationshipsController extends Controller
{
    private $service;

    public function __construct(JSONAPIService $service)
    {
        $this->service = $service;
    }

    public function index(Book $book)
    {
        return $this->service->fetchRelationship($book, 'authors');
    }

    public function update(JSONAPIRelationshipRequest $request, Book $book)
    {

        if(Gate::denies('admin-only')){
            throw new AuthorizationException('This action is
            unauthorized.');
        }
        
        return $this->service->updateManyToManyRelationships($book, 'authors', $request->input('data.*.id'));


    }
}
