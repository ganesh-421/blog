<?php

namespace App\Http\Controllers;

use App\Models\User;

class AuthorController extends Controller
{
    
    public function index(User $author) {
        return view('posts.index', [
            'posts' => $author->posts
        ]);
    }
}