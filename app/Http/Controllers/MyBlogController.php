<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class MyBlogController extends Controller
{
    const POSTS_PER_PAGE = 5; // Количество записей на странице

    public function index()
    {
        $posts = BlogPost::orderBy('created_at', 'desc')->paginate(self::POSTS_PER_PAGE);
        return view('MyBlog.index', compact('posts'));
    }


    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'content' => 'required|string',
    ]);

    $post = new Post();
    $post->title = $request->title;
    $post->content = $request->content;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        $post->image = $path;
    }

    $post->save();

    return redirect()->route('blog.index')->with('success', 'Запись добавлена успешно.');
}

}


