<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Toggles the like status for a post for the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggle(Request $request, Post $post)
    {
        // Find if a like from the current user already exists for this post
        $like = $post->likes()->where('user_id', auth()->id())->first();

        if ($like) {
            // If it exists, the user is "unliking" the post, so we delete it.
            $like->delete();
            $liked = false;
        } else {
            // If it does not exist, the user is "liking" the post, so we create it.
            $post->likes()->create(['user_id' => auth()->id()]);
            $liked = true;
        }

        // Return a JSON response with the current like status and the new total count.
        return response()->json([
            'liked' => $liked,
            'like_count' => $post->likes()->count()
        ]);
    }
}