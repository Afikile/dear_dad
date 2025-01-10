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
        $letters = Letter::latest()->paginate(10);
        return view('letters.index', compact('letters'));
    }

    // Show form to create a new letter
    public function create()
    {
        return view('letters.create');
    }

    // Store a new letter
    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'string', 'max:255', new ProhibitedWords()],
        ]);

        $letter = new Letter();
        $letter->content = $request->content;
        $letter->user_id = Auth::id();
        $letter->username = Auth::user()->username;
        $letter->save();

        return redirect()->route('letters.index')->with('success', 'Letter submitted successfully!');
    }

    // Show form to edit a letter
    public function edit(Letter $letter)
    {
        $this->authorize('update', $letter);
        return view('letters.edit', compact('letter'));
    }

    // Update an existing letter
    public function update(Request $request, Letter $letter)
    {
        $request->validate([
            'content' => ['required', 'string', 'max:255', new ProhibitedWords()],
        ]);

        $this->authorize('update', $letter);
        $letter->content = $request->content;
        $letter->save();

        return redirect()->route('letters.index')->with('success', 'Letter updated successfully!');
    }

    // Delete a letter
    public function destroy(Letter $letter)
    {
        $this->authorize('delete', $letter);
        $letter->delete();

        return redirect()->route('letters.index')->with('success', 'Letter deleted successfully!');
    }

    // Show a single letter
    public function show(Letter $letter)
    {
        return view('letters.show', compact('letter'));
    }
}
