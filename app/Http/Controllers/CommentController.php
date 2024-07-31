<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'content' => 'required|string',
        'blog_post_id' => 'required|exists:blog_posts,id',
    ]);

    $comment = Comment::create([
        'content' => $request->content,
        'blog_post_id' => $request->blog_post_id,
        'user_id' => auth()->id(),
    ]);

    return view('partials.comment', compact('comment'))->render();
}
}