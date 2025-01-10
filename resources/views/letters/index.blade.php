@extends('layouts.app')

@section('title', 'Letters')

@section('content')
    <h1 class="mb-4">Letters</h1>

    @auth
        <!-- Show Compose Button for Logged-in Users -->
        <a href="{{ route('letters.create') }}" class="btn btn-primary mb-4">Compose a New Letter</a>
    @endauth

    <div class="list-group">
        @foreach ($letters as $letter)
            <a href="{{ route('letters.show', $letter->id) }}" class="list-group-item list-group-item-action">
                <strong>{{ $letter->username }}</strong>: {{ Str::limit($letter->content, 50) }}
            </a>

            @auth
                @if (Auth::id() === $letter->user_id) <!-- Check if the logged-in user owns the letter -->
                    <div class="mt-2">
                        <!-- Edit Button -->
                        <a href="{{ route('letters.edit', $letter->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <!-- Delete Button -->
                        <form action="{{ route('letters.destroy', $letter->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                @endif
            @endauth
        @endforeach
    </div>

    <div class="mt-4">
        {{ $letters->links() }}
    </div>
@endsection
