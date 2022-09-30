<?php

namespace App\Http\Controllers;

use App\Author;
use App\Http\Requests\JSONAPIRequest;
use Illuminate\Http\Request;
use App\Services\JSONAPIService;
use App\Http\Resources\JSONAPIResource;

class AuthorController extends Controller
{
    private $service;

    public function __construct(JSONAPIService $service)
    {
         $this->service = $service;
    }

    public function index()
    {
        return $this->service->fetchResources(Author::class, 'authors');
    }


    
    public function store(JSONAPIRequest $request)
    {
        return $this->service->createResource(Author::class, $request->input('data.attributes'));

    }

   
    public function show(Author $author)
    {
        return $this->service->fetchResource(Author::class, $author, 'authors');
    }

   

    
    public function update(JSONAPIRequest $request, Author $author){

        return $this->service->updateResource($author, $request->input('data.attributes'));
    }
    

   
    public function destroy(Author $author){

    return $this->service->deleteResource($author);
    }

}
