<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->prefix('v1')->group(function(){
    Route::get('/users', function (Request $request) {
    return $request->user();
    });
    
    // Authors
    Route::apiResource('authors', 'AuthorController');

    Route::get('authors/{author}/relationships/books', 'AuthorsBooksRelationshipsController@index') ->name('authors.relationships.books');

    Route::patch('authors/{author}/relationships/books', 'AuthorsBooksRelationshipsController@update')->name('authors.relationships.books');

    Route::get('authors/{author}/books', 'AuthorsBooksRelatedController@index')->name('authors.books');

    // Books
    Route::apiResource('books', 'BookController');

    Route::get('books/{book}/relationships/authors', 'BooksAuthorsRelationshipsController@index')->name('books.relationships.authors');
    
    Route::get('books/{book}/authors', function(){return true;})->name('books.authors');
        
    Route::patch('books/{book}/relationships/authors', 'BooksAuthorsRelationshipsController@update')->name('books.relationships.authors');

    Route::get('books/{book}/authors', 'BooksAuthorsRelatedController@index')->name('books.authors');

    // Users
    Route::get('/users/current', 'CurrentAuthenticatedUserController@show');
   Route::apiResource('users', 'UsersController');

   Route::get('users/{user}/relationships/comments', 'UsersCommentsRelationshipsController@index')->name('users.relationships.comments');
   Route::patch('users/{user}/relationships/comments', 'UsersCommentsRelationshipsController@update')->name('users.relationships.comments');
   Route::get('users/{user}/comments', 'UsersCommentsRelatedController@index')->name('users.comments');

   // Comments

    Route::apiResource('comments', 'CommentsController');

    Route::get('comments/{comment}/relationships/users', 'CommentsUsersRelationshipsController@index')->name('comments.relationships.users');

    Route::patch('comments/{comment}/relationships/users', 'CommentsUsersRelationshipsController@update')->name('comments.relationships.users');

    Route::get('comments/{comment}/users', 'CommentsUsersRelatedController@show')->name('comments.users');

    Route::get('comments/{comment}/relationships/books', 'CommentsBooksRelationshipsController@index')->name('comments.relationships.books');

    Route::patch('comments/{comment}/relationships/books', 'CommentsBooksRelationshipsController@update')->name('comments.relationships.books');

    Route::get('comments/{comment}/books', 'CommentsBooksRelatedController@show')->name('comments.books');

    });
