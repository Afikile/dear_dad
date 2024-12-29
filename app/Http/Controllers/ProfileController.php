<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validate incoming request data, including username
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $request->user()->id, // Unique validation, ignoring the current user's username
        ]);

        // Get the authenticated user
        $user = $request->user();

        // Update name, surname, and username
        $user->fill($request->only(['name', 'surname', 'username']));

        // Save the updated user data
        $user->save();

        // Redirect back with success message
        return Redirect::route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validate password for account deletion
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Log out user and delete account
        Auth::logout();

        $user->delete();

        // Invalidate the session and regenerate the token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
