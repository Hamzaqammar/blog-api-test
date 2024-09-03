<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{

    use AuthorizesRequests;
    
    public function index()
    {
        return BlogPost::paginate(10);
    }

    public function store(Request $request)
    {
        $user = $request->user(); // Get the authenticated user

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = new BlogPost($validatedData);
        $user->blogPosts()->save($post); // Use the blogPosts() relationship method

        return response()->json($post, 201);
    }

    public function show(BlogPost $blogPost)
    {
        return response()->json($blogPost);
    }

    public function update(Request $request, $id)
    {
        $user = $request->user(); // Get the authenticated user
    
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
    
        // Find the post by ID, ensuring it belongs to the authenticated user
        $post = $user->blogPosts()->findOrFail($id);
    
        // Update the post with validated data
        $post->update($validatedData);
    
        return response()->json($post, 200);
    }
    

    public function destroy(Request $request,$id)
    {
        $user = $request->user();
        $post = $user->blogPosts()->findOrFail($id);
    
        // Update the post with validated data
        $post->delete();
    
        return response()->json(['message'=>'Blog Deleted Successfully'], 200);
    }
}

