<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Post $post)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'body' => 'required|string|max:2500',
        ]);

        // Create the comment and associate it with the post and logged-in user
        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $validatedData['body'],
        ]);

        // Eager load the user relationship so the user's name is included
        $comment->load('user');

        // Return the newly created comment as a JSON response
        return response()->json($comment);
    }
}