@extends('layouts.app')

@section('title', 'Letters')

@section('content')
    <h1 class="mb-4">Letters</h1>
    <div class="list-group">
        @foreach ($letters as $letter)
            <a href="{{ route('letters.show', $letter->id) }}" class="list-group-item list-group-item-action">
                <strong>{{ $letter->username }}</strong>: {{ Str::limit($letter->content, 50) }}
            </a>

            <!-- Edit and Delete Links (shown only for the logged-in user) -->
            @auth
                @if (Auth::id() === $letter->user_id) <!-- Check if the logged-in user owns the letter -->
                    <div class="mt-2">
                        <a href="{{ route('letters.edit', $letter->id) }}" class="btn btn-sm btn-warning">Edit</a>

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
