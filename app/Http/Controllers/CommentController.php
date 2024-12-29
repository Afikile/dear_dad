<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Letter;

class CommentController extends Controller
{
    // Store a new comment
    public function store(Request $request, $letterId)
    {
        // Find the letter by ID
        $letter = Letter::findOrFail($letterId);

        // Check if comments are allowed on the letter
        if (!$letter->allow_comments) {
            return redirect()->route('letters.show', $letterId)
                             ->with('error', 'Comments are disabled for this letter.');
        }

        // Validate the comment
        $request->validate([
            'body' => 'required|string|max:500',
        ]);

        // Store the comment
        Comment::create([
            'body' => $request->body,
            'letter_id' => $letterId,
            'user_id' => auth()->id(), // Associate the comment with the logged-in user
        ]);

        return redirect()->route('letters.show', $letterId)->with('success', 'Comment added successfully!');
    }

    // Edit an existing comment
    public function edit(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('comments.edit', compact('comment'));
    }

    // Update an existing comment
    public function update(Request $request, Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'body' => 'required|max:300',
        ]);

        $comment->update(['body' => $request->body]);

        return redirect()->route('letters.show', $comment->letter_id)
                         ->with('success', 'Comment updated successfully!');
    }

    // Delete an existing comment
    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->route('letters.show', $comment->letter_id)
                         ->with('success', 'Comment deleted successfully!');
    }

    

}
