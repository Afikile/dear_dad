<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function sendVerificationEmail(Request $request)
    {
        // Check if the user has already verified their email
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        // Send the verification notification to the user
        $request->user()->sendEmailVerificationNotification();

        // Redirect back with a success message
        return back()->with('status', 'Verification link sent!');
    }
}
