<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Letter;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Letter $letter)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $letter->comments()->create($request->all()); 

        return redirect()->route('letters.show', $letter)->with('success', 'Comment added successfully!');
    }
}
