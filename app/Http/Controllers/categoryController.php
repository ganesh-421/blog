<?php

namespace App\Http\Controllers;

use App\Models\Category;

class categoryController extends Controller
{
    public function index(Category $category) {
        return view('posts', [
            'posts' => $category->posts,
            'currentCategory' => $category,
            'categories' => Category::all()]);
    }
    public function create()
    {
        
    }
}