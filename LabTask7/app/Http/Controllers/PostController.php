<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // Eager load user and categories, and get comment count
        $posts = Post::with(['user', 'categories'])->withCount('comments')->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'categories' => 'required|array'
        ]);

        // Create Post (Hardcoding user_id = 1 for demo purposes)
        $post = Post::create([
            'user_id' => 1, 
            'title' => $request->title,
            'body' => $request->body
        ]);

        // Attach Categories (Pivot table)
        $post->categories()->attach($request->categories);

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        // Load comments for this post
        $post->load('comments'); 
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'categories' => 'array'
        ]);

        $post->update($request->only(['title', 'body']));

        // Sync updates the pivot table
        $post->categories()->sync($request->categories);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}