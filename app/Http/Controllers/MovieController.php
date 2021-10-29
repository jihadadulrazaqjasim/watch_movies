<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Movie;
use App\Category;
use App\Rating;

use App\Http\Resources\Movie as MovieResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //showing all movies..
    public function index()
    {

        //get current route and check if it is api request or web.
        $route=Route::current()->uri();
        if (strpos($route, 'api') !== false) {

            //Get the movies
            $movies = Movie::paginate(5);

            // Return collection of movies as a resource
            return MovieResource::collection($movies);
        }
        else{
            $movies=Movie::all();

            return view('movies.index')->with('movies',$movies);
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Using for creating
    public function store(Request $request)
    {
        // Allow for movie update *or* create a new movie
        $movie = new Movie;
        $movie->category_id=$request->input('category_id');
        $movie->movie_title = $request->input('movie_title');
        $movie->movie_time  = $request->input('movie_time');
        $movie->movie_language  = $request->input('movie_language');
        $movie->movie_rel_date  = $request->input('movie_rel_date');
        $movie->movie_rel_country  = $request->input('movie_rel_country');
        $movie->rate_of_movie  = $request->input('rate_of_movie');


//      return new MovieResource($movie);
        if ($movie->save()) {
            return response()->json(['success'=>'process is successful..'],200);
        }
    }



    public function edit($id)
    {
        $data = Movie::findOrFail($id);

        $html = '<div class="form-group">
                    <label for="movie_title">Movie Title:</label>
                    <input type="text" class="form-control" name="movie_title" id="edit_movie_title" value="'.$data->movie_title.'">
                </div>
                <div class="form-group">
                    <label for="category_id">Category ID:</label>
                    <input type="text" class="form-control" name="category_id" id="edit_category_id" value="'.$data->category_id.'">
                </div>
                
                 <div class="form-group">
                    <label for="movie_time">Movie Time:</label>
                    <input type="text" class="form-control" name="movie_time" id="edit_movie_time" value="'.$data->movie_time.'">
                </div>
                
                 <div class="form-group">
                    <label for="movie_language">Movie Language:</label>
                    <input type="text" class="form-control" name="movie_language" id="edit_movie_language" value="'.$data->movie_language.'">
                </div>
                
                 <div class="form-group">
                    <label for="movie_rel_date">Movie Release Date:</label>
                    <input type="datetime" class="form-control" name="movie_rel_date" id="edit_movie_rel_date" value="'.$data->movie_rel_date.'">
                </div>
                
                 <div class="form-group">
                    <label for="movie_rel_country">Movie Release Country:</label>
                    <input type="text" class="form-control" name="movie_rel_country" id="edit_movie_rel_country" value="'.$data->movie_rel_country.'">
                </div>
                
                 <div class="form-group">
                    <label for="rate_of_movie">Rate of Movie:</label>
                    <input type="text" class="form-control" name="rate_of_movie" id="edit_rate_of_movie" value="'.$data->rate_of_movie.'">
                </div>
                ';

        return response()->json(['html'=>$html]);
    }

    public function update(Request $request, $id)
    {
//        $validator = \Validator::make($request->all(), [
//            'name' => 'required',
//            'description' => 'required',
//            'price' => 'required',
//        ]);

//        if ($validator->fails()) {
//            return response()->json(['errors' => $validator->errors()->all()]);
//        }

        Movie::where('id',$id)->update($request->all());

        return response()->json(['success'=>'Product updated successfully'],200);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //showing a specific movie based on id
    public function show($id)
    {
        // Get a single movie
        $movie = Movie::findOrFail($id);

        // Return a single movie as a resource
        return new MovieResource($movie);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //deleting a movie
    public function destroy($id)
    {
        // Get the movie
        $movie = Movie::findOrFail($id);

        //  Delete the Movie, return as confirmation
//        if ($movie->delete()) {
//            return new MovieResource($movie);
//        }

        if($movie->delete()){
            return response()->json(['success'=>'Movie deleted successfully'],200);
        }

    }

    //getting movies of a specific category using category id.
    public function get_movies_by_category($id)
    {
        // Get a single category based on ID
        $category = Category::findOrFail($id);

        $movies = $category->movies;

        return new MovieResource($movies);
    }

    //getting movies based on a language code coming with parameter.
    public  function get_movies_by_language($lang)
    {
       $results= DB::select('select * from movies where movie_language=?',[$lang]);

       return response()->json(['result' => $results], 200);
    }



//------------------COMMEEEEENNNNNNTTTTTTT----------------------

//        public function get_users_that_saved_specific_movie($movie_id){
//        $movie=Movie::findOrFail($movie_id);
//
//        $user_ids=[];
//
//        foreach ($movie->saved_by_users as $user) {
//            $user_ids[]=$user->pivot->user_id;
//        }
//
//        return response()->json(['users' => $user_ids], 200);
//    }

//-----------------ENNNNNNNDDDDDD------------------------------


    //Route::get api/movie/users/movie_id
//    public function get_users_that_saved_specific_movie($movie_id)
//    {
//        $movie=Movie::findOrFail($movie_id);
//        $users=$movie->saved_by_users;
//        return response()->json(['users' => $users], 200);
//    }





    //Using for adding a movie to a user's saved movies list..
    //Route:post api/movie/save_movie/user_id/movie_id
    public function save_movie(Request $request)
    {
        $user=User::findOrFail($request->input('user_id'));
        $user->saved_movies()->attach($request->input('movie_id'));
        return response()->json(['message'=> 'success', 200]);
    }

    //Getting saved movies based on user_id passing by url..
    //Route::get api/saved_movies/user_id
    public function get_saved_movies($user_id){
        $user=User::findOrFail($user_id);
        $movies=$user->saved_movies;

        return response()->json(['movies'=>$movies],200);
    }

    //Using for adding a star to a specific movie by a specific user..
    //Route::post  api/movie/star
    public function add_star_to_movie(Request $request)
    {
        $movie=Movie::findOrFail($request->movie_id);
        $rating = new Rating(['movie_id'=>$request->input('movie_id'),'user_stars'=>$request->input('user_stars')]);

        $movie->ratings()->save($rating);
        return response()->json(['message'=> "success", 200]);
    }


}