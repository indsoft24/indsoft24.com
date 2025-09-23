<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of all comments.
     */
    public function index()
    {
        // Eager load relationships for efficiency
        $comments = Comment::with(['user', 'post'])->latest()->paginate(20);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for editing the specified comment.
     */
    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', compact('comment'));
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $validatedData = $request->validate([
            'body' => 'required|string|max:2500',
        ]);

        $comment->update($validatedData);

        return redirect()->route('admin.comments.index')->with('success', 'Comment updated successfully.');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')->with('success', 'Comment deleted successfully.');
    }
}