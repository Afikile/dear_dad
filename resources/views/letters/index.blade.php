@extends('layouts.app')

@section('title', 'Letters')

@section('content')
    <div class="container-sm">
        <h1 class="mb-4 text-center">Letters</h1>

        @auth
            <!-- Show Compose Button for Logged-in Users -->
            <div class="text-center mb-4">
                <a href="{{ route('letters.create') }}" class="btn btn-primary">Compose a New Letter</a>
            </div>
        @endauth

        <div class="list-group">
            @foreach ($letters as $letter)
                <div class="list-group-item max-width-item">
                    <a href="{{ route('letters.show', $letter->id) }}" class="text-decoration-none text-dark">
                        <strong>{{ $letter->username }}</strong>: {{ Str::limit($letter->content, 50) }}
                    </a>

                    @auth
                        @if (Auth::id() === $letter->user_id) <!-- Check if the logged-in user owns the letter -->
                            <div class="mt-2 d-flex justify-content-start gap-2">
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
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $letters->links() }}
        </div>
    </div>

@endsection

@push('styles')
    <style>
        /* Constrain the width of each list item */
        .max-width-item {
            max-width: 600px; /* Adjust this value to make it narrower or wider */
            margin: 0 auto; /* Center align the items */
        }
    </style>
@endpush
