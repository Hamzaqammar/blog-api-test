<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, BlogPost $blogPost)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);

        $comment = $blogPost->comments()->create([
            'user_id' => $request->user()->id,
            'content' => $validatedData['content'],
        ]);

        return response()->json($comment, 201);
    }

    public function index(BlogPost $blogPost)
    {
        return response()->json($blogPost->comments()->paginate(10));
    }
}

