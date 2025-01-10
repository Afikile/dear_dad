<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\ProhibitedWords;

class LetterController extends Controller
{
    // Show all letters
    public function index()
    {
        // Retrieve the letters with pagination
        $letters = Letter::latest()->paginate(10);
        return view('letters.index', compact('letters'));
    }

    // Show form to create a new letter
    public function create()
    {
        // Ensure the user is authenticated before creating a letter
        $this->middleware('auth');

        return view('letters.create');
    }

    // Store a new letter
    public function store(Request $request)
    {
        // Validate the letter content, preventing prohibited words
        $request->validate([
            'content' => ['required', 'string', 'max:255', new ProhibitedWords()],
        ]);

        // Create a new letter and associate it with the logged-in user's username
        $letter = new Letter();
        $letter->content = $request->content;
        $letter->username = Auth::user()->username; // Store the username from the authenticated user
        $letter->save();

        return redirect()->route('letters.index')->with('success', 'Letter submitted successfully!');
    }

    // Show form to edit a letter
    public function edit(Letter $letter)
    {
        // Ensure the user is authorized to update the letter (only the owner can edit)
        $this->authorize('update', $letter);

        return view('letters.edit', compact('letter'));
    }

    // Update an existing letter
    public function update(Request $request, Letter $letter)
    {
        // Ensure the user is authorized to update the letter
        $this->authorize('update', $letter);

        // Validate and update the letter content
        $request->validate([
            'content' => ['required', 'string', 'max:255', new ProhibitedWords()],
        ]);

        // Update the letter with the new content
        $letter->content = $request->content;
        $letter->save();

        return redirect()->route('letters.index')->with('success', 'Letter updated successfully!');
    }

    // Delete a letter
    public function destroy(Letter $letter)
    {
        // Ensure the user is authorized to delete the letter (only the owner can delete)
        $this->authorize('delete', $letter);

        // Delete the letter
        $letter->delete();

        return redirect()->route('letters.index')->with('success', 'Letter deleted successfully!');
    }

    // Show a single letter
    public function show(Letter $letter)
    {
        return view('letters.show', compact('letter'));
    }
}
