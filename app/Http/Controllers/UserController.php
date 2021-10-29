<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::findOrFail($id);

        $user->name=$request->input('name');
        $user->account_type=$request->input('account_type');
        $user->age=$request->input('age');
        $user->gender=$request->input('gender');
        $user->email=$request->input('email');
        $user->password=$request->input('password');

        $user->save();
        return response()->json(['data'=>$user],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    //Getting new users per day...
    //Route:get api/users/new_users
    public function get_users_per_day(){
        $users = DB::table("users")
            ->select('id')
            ->whereDate('created_at', '>', Carbon::now()->subDay())
            ->get();

        return response()->json(['data'=>$users],200);
    }

    public function fav_movie_by_gender($gender){
       $users=User::all()->where('gender','=',$gender);
       foreach ($users as $user){

       }
    }
}