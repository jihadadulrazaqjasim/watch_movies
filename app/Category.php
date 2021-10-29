<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function movies(){

        return $this->hasMany('App\Movie');
    }
}