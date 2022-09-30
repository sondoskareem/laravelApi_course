<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JSONAPIService;
use App\User;
class UsersCommentsRelatedController extends Controller
{
    private $service;
    public function __construct(JSONAPIService $service){
        $this->service = $service;
    }


    public function index(User $user){
        return $this->service->fetchRelated($user, 'comments');
    }

    
}
