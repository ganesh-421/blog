<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        // return all posts with pagination including 50 posts per page.
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }
    /**
     * return a view to create a new post
     */
    public function create()
    {
        
        return view('admin.posts.create');
    }
    /**
     * store the created post in database
     * track who posted the post
     * store thumbnail in storage/app/public/thumnails
     */
    public function store()
    {
        Post::create(array_merge($this->validatePost(), [
            'user_id' => auth()->id(),
            'thumbnail' => request('thumbnail')->store('thumbnails'),
        ]));
        // or you can do::
        // request()->user()->posts()->create(); 
        return redirect('/')->with('success', 'New post created.');
    }
    /**
     * return a view to edit the post
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }
    /**
     * update the post in database
     * track who updated the post
     * store thumbnail in storage/app/public/thumnails
     */
    public function update(Post $post)
    {
        $attr = $this->validatePost($post);
        $attr['user_id'] = auth()->id();
        if (isset($attr['thumbnail']) ?? false) {
            $attr['thumbnail'] = request('thumbnail')->store('thumbnails');
        }
        $post->update($attr);
        return back()->with('success', 'Post Updated Successfully!');
    }
    /**
     * delete the post from database
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', "Post Deleted Successfully!");
    }
    /**
     * validate the post
     * @param Post $post
     * @return array
     */
    protected function validatePost(?Post $post = null)
    {
        $post ??= new Post(); //assigns when there is no post
        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);
    }
}