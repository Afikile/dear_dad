@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Profile Section -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4>Profile</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Username:</strong> {{ $user->username }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Letters Section -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h4>Your Letters</h4>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @if($letters->isEmpty())
                                <p>You haven't written any letters yet.</p>
                            @else
                                @foreach ($letters as $letter)
                                    <a href="{{ route('letters.show', $letter->id) }}" class="list-group-item list-group-item-action">
                                        <strong>{{ $letter->username }}</strong>: {{ Str::limit($letter->content, 50) }}
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
