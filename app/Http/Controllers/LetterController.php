<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LetterController extends Controller
{
    public function index()
    {
        $letters = Letter::latest()->paginate(10);
        return view('letters.index', compact('letters'));
    }

    public function create()
    {
        return view('letters.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'content' => 'required|string|max:255|prohibited_words',
        ]);

        // Create the new letter and associate with the authenticated user
        $letter = new Letter();
        $letter->content = $request->content;
        $letter->user_id = Auth::id();  // Associate letter with the authenticated user
        $letter->username = Auth::user()->username;  // Set the username for the letter
        $letter->save();

        return redirect()->route('letters.index')->with('success', 'Letter submitted successfully!');
    }

    public function edit(Letter $letter)
    {
        // Ensure the user is authorized to edit this letter
        $this->authorize('update', $letter);

        return view('letters.edit', compact('letter'));
    }

    public function update(Request $request, Letter $letter)
    {
        // Validate input
        $request->validate([
            'content' => 'required|string|max:255|prohibited_words',
        ]);

        // Ensure the user is authorized to update this letter
        $this->authorize('update', $letter);

        // Update the letter content
        $letter->content = $request->content;
        $letter->save();

        return redirect()->route('letters.index')->with('success', 'Letter updated successfully!');
    }

    public function destroy(Letter $letter)
    {
        // Ensure the user is authorized to delete this letter
        $this->authorize('delete', $letter);

        // Delete the letter
        $letter->delete();

        return redirect()->route('letters.index')->with('success', 'Letter deleted successfully!');
    }

    public function show(Letter $letter)
    {
        return view('letters.show', compact('letter'));
    }
}
