<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use App\Models\Letter;

class ReplyController extends Controller
{
    /**
     * Store a new reply for a given letter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $letter_id
     * @return \Illuminate\View\View
     */
    public function store(Request $request, $letter_id)
    {
        // Validate the incoming request data
        $request->validate([
            'body' => 'required|string|max:300', // The reply body should not exceed 300 characters
            'parent_id' => 'nullable|exists:replies,id', // Validate that parent_id, if provided, exists in the replies table
        ]);

        // Create a new reply entry in the replies table
        $reply = Reply::create([
            'letter_id' => $letter_id, // Associate the reply with the specific letter
            'user_id' => auth()->id(), // Associate the reply with the currently authenticated user
            'body' => $request->input('body'), // Store the body of the reply
            'parent_id' => $request->input('parent_id'), // Set the parent_id if it's provided (for nested replies)
        ]);

        // Fetch the letter that the reply is associated with
        $letter = Letter::findOrFail($letter_id); // This ensures the letter exists, or an error will be thrown

        // Fetch all replies for the given letter, including any nested child replies
        $replies = Reply::where('letter_id', $letter_id)
            ->with('children') // Eager load child replies to avoid N+1 query problem
            ->get();

        // Return the same page with the updated list of replies
        return view('letters.show', compact('letter', 'replies'));
    }
}
