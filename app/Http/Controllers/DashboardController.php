<?php
namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $letters = Letter::where('user_id', $user->id)->get();

        return view('dashboard', compact('user', 'letters'));
    }
}
