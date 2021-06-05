<?php
use App\User;
use App\Book;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
    //return $request->user();
    Route::get('export/{filter}', 'BookController@export');
    
   
    Route::apiResource('users', 'UserController');
    Route::apiResource('books', 'BookController');
  

    
   
