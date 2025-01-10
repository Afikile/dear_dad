@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>{{ $letter->username }}'s Letter</h3>
        <p>{{ $letter->content }}</p>

        <!-- Show edit and delete buttons if the logged-in user is the letter's author -->
        @auth
            @if (Auth::id() === $letter->user_id) <!-- Check if the logged-in user owns the letter -->
                <div class="mt-3">
                    <a href="{{ route('letters.edit', $letter->id) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('letters.destroy', $letter->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this letter?')">Delete</button>
                    </form>
                </div>
            @else
                <p>You cannot edit or delete this letter because it is not yours.</p>
            @endif
        @endauth
    </div>
@endsection
