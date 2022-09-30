<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $service;
    public function __construct(JSONAPIService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->fetchResources(User::class, 'users');
    }

    
    public function store(Request $request)
    {
        return $this->service->createResource(User::class, [
            'name' => $request->input('data.attributes.name'),
            'email' => $request->input('data.attributes.email'),
            'password' => Hash::make(($request->input('data.attributes.password'))),
        ]);
    }

    
    public function show($id)
    {
        return $this->service->fetchResource(User::class, $user, 'users');

    }

    
    public function update(Request $request, $id)
    {
         $attributes = $request->input('data.attributes');
        if(isset($attributes['password'])){
            $attributes['password'] = Hash::make($attributes['password']);
        }

        return $this->service->updateResource($user, $attributes);
    }

    
    public function destroy($id)
    {
        return $this->service->deleteResource($user);
    }
}
