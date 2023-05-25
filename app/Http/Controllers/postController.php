<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class postController extends Controller
{
    /**
     * return all posts along with filters if any
     * paginate the posts
     */
    public function index()
    {
        // dd(Gate::allows('admin'));
        // auth()->user()->can('admin) is same as Gate::allows('admin'), cannot('admin') is opposite.. 
        // or you can say, $this->authorize('admin'); authorize xaina vane, it return 403 error.. 
        return view('posts.index', [
            'posts' => Post::latest()
                ->filter(request(['search', 'category', 'author']))
                ->simplePaginate(6)->withQueryString()
        ]);
    }
    /**
     * return details of a single post
     * RMB helps fetch the post from the database without having to write a query
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
        // return view('posts.show', ['post' => $post]);
    }
}