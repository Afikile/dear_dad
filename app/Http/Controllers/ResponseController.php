<?php

// app/Http/Controllers/ResponseController.php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Letter;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'body' => 'required|max:300',
        ]);

        $reply = new Reply();
        $reply->body = $request->body;
        $reply->user_id = auth()->id();
        $reply->post_id = $postId;
        $reply->save();

        return redirect()->route('posts.show', $postId)->with('success', 'Reply added successfully!');
    }

}
