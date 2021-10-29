<?php

namespace App\Http\Controllers;
use App\Http\Resources\Category as CategoryResource;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        //Get the categories
        $categories = Category::paginate(5);

        // Return all categories
        return CategoryResource::collection($categories);
    }
}