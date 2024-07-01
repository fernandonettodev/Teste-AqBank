<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'App\Http\Controllers\Api\AuthController@login')->name('login');
    Route::post('logout', 'App\Http\Controllers\Api\AuthController@logout')->name('logout');
    Route::get('refresh', 'App\Http\Controllers\Api\AuthController@refresh')->name('refresh');

});

Route::group(['middleware' => 'admin'], function () {

    //START - Authors
    Route::get('/authors', 'App\Http\Controllers\Api\AuthorController@index')->name('authors.index');
    Route::get('/authors/{id}', 'App\Http\Controllers\Api\AuthorController@show')->name('authors.show');
    Route::post('/authors', 'App\Http\Controllers\Api\AuthorController@create')->name('authors.create');
    Route::patch('/authors/{id}', 'App\Http\Controllers\Api\AuthorController@update')->name('authors.update');
    Route::delete('/authors/{id}', 'App\Http\Controllers\Api\AuthorController@delete')->name('authors.delete');

    //START - Books
    Route::get('/books', 'App\Http\Controllers\Api\BookController@index')->name('books.index');
    Route::get('/books/{id}', 'App\Http\Controllers\Api\BookController@show')->name('books.show');
    Route::post('/books', 'App\Http\Controllers\Api\BookController@create')->name('books.create');
    Route::patch('/books/{id}', 'App\Http\Controllers\Api\BookController@update')->name('books.update');
    Route::delete('/books/{id}', 'App\Http\Controllers\Api\BookController@delete')->name('books.delete');

    //START - Loans
    Route::get('/loans', 'App\Http\Controllers\Api\LoanController@index')->name('loans.index');
    Route::get('/loans/{id}', 'App\Http\Controllers\Api\LoanController@show')->name('loans.show');
    Route::post('/loans', 'App\Http\Controllers\Api\LoanController@create')->name('loans.create');
    Route::patch('/loans/{id}/return', 'App\Http\Controllers\Api\LoanController@returnBook')->name('loans.returnBook');
    Route::delete('/loans/{id}', 'App\Http\Controllers\Api\LoanController@delete')->name('loans.delete');
    
});