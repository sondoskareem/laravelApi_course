<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use App\Http\Requests\JSONAPIRequest;
use App\Services\JSONAPIService;
use App\Http\Resources\JSONAPIResource;
class AuthorsBooksRelationshipsController extends Controller
{
    private $service;

    public function __construct(JSONAPIService $service)
    {
        $this->service = $service;
    }

    public function index(Author $author){
        return $this->service->fetchRelationship($author, 'books');
    }

    public function update(JSONAPIRelationshipRequest $request, Author $author){
         return $this->service->updateManyToManyRelationships($author, 'books', $request->input('data.*.id'));
    }

}
