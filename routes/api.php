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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// List all movies
Route::get('movies', 'MovieController@index');

// List a single movie
Route::get('movie/{id}', 'MovieController@show');

// Create a new movie
Route::post('movie', 'MovieController@store');

// Update a movie
Route::put('movie', 'MovieController@store');

// Delete a movie
Route::delete('movie/{id}', 'MovieController@destroy');



//Get Movies based on Category
Route::get('movie/category/{id}','MovieController@get_movies_by_category');

//Get Movies based on language
Route::get('movie/language/{lang}','MovieController@get_movies_by_language');

//Get all categories
Route::get('categories','CategoryController@index');


//Get users that saved specific movie based on movie id coming in parameter
//Route::get('movie/users/{movie_id}','MovieController@get_users_that_saved_specific_movie');


//Saving user favourite movies
Route::post('movie/save_movie','MovieController@save_movie');


//Getting saved movies based on user_id..
Route::get('saved_movies/{user_id}','MovieController@get_saved_movies');


//Adding star to a specific movie by a specific user
Route::post('movie/star','MovieController@add_star_to_movie');


//Update user info
Route::put('user/{id}','UserController@update');


//Get Users Per Day
Route::get('users/new_users','UserController@get_users_per_day');