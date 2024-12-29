<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Letter; // Import the Letter model
use App\Models\Reply;  // Import the Reply model

class LetterController extends Controller
{
    public function index()
    {
        // Retrieve all letters and pass them to the view
        $letters = Letter::with('user')->paginate(10);

        return view('letters.index', compact('letters'));
    }

    public function destroy($id)
    {
        // Find the letter by its ID
        $letter = Letter::findOrFail($id);

        // Ensure only the owner can delete
        if (auth()->id() !== $letter->user_id) {
            return redirect()->route('letters.index')->with('error', 'Unauthorized action.');
        }

        // Delete the letter
        $letter->delete();

        return redirect()->route('letters.index')->with('success', 'Letter deleted successfully.');
    }

    // Show the letter and its replies
    public function show($id)
    {
        // Retrieve the letter by ID with its associated user and replies
        $letter = Letter::with('user')->findOrFail($id);
        
        // Check if there are replies for the letter
        $replies = $letter->replies()
                          ->with('user') // Include user data for each reply
                          ->latest() // Get the latest replies first
                          ->get();

        // Check if there are replies and log it or pass additional info if needed
        if ($replies->isEmpty()) {
            // Handle the case where there are no replies (optional)
            session()->flash('info', 'No replies yet. Be the first to reply!');
        }

        // Pass the letter and replies to the view
        return view('letters.show', compact('letter', 'replies'));
    }

    // Push a letter to the top (update the timestamp)
    public function pushUp($id)
    {
        // Find the letter by its ID
        $letter = Letter::findOrFail($id);

        // Update the `updated_at` timestamp to move the letter to the top
        $letter->touch();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Letter pushed to the top successfully!');
    }

    // Edit a letter
    public function edit($id)
    {
        // Find the letter by its ID
        $letter = Letter::findOrFail($id);

        // Check if the logged-in user is the owner of the letter
        if (auth()->id() !== $letter->user_id) {
            return redirect()->route('letters.index')->with('error', 'Unauthorized access.');
        }

        // Return the edit view with the letter data
        return view('letters.edit', compact('letter'));
    }

    // Update a letter
    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Find the letter by its ID
        $letter = Letter::findOrFail($id);

        // Update the letter with new data
        $letter->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        // Redirect back with a success message
        return redirect()->route('letters.show', $letter->id)->with('success', 'Letter updated successfully!');
    }

    // Show the form to create a new letter
    public function create()
    {
        return view('letters.create'); // Ensure you have a 'create.blade.php' file in the 'letters' folder
    }

    // Store a new letter
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'allow_comments' => 'nullable|boolean', // Validate checkbox value
        ]);

        // Create the new letter
        Letter::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(), // Associate the letter with the logged-in user
            'allow_comments' => $request->has('allow_comments'), // Store if the checkbox is checked
        ]);

        return redirect()->route('letters.index')->with('success', 'Letter created successfully!');
    }

    // Store a new reply to a letter
    public function storeReply(Request $request, $letter_id)
    {
        $request->validate([
            'body' => 'required|string|max:300',
            'parent_id' => 'nullable|exists:replies,id', // Optional: if replying to another reply
        ]);

        // Create the reply, associating it with the letter and the logged-in user
        $reply = Reply::create([
            'letter_id' => $letter_id,
            'user_id' => auth()->id(),
            'body' => $request->body,
            'parent_id' => $request->parent_id, // Optional: set if replying to a previous reply
        ]);

        // Redirect back to the letter's page with the new reply
        return redirect()->route('letters.show', $letter_id)->with('success', 'Reply posted successfully!');
    }
}
