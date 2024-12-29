@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Display Success Message -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Loop through all letters and display them -->
    <div class="space-y-6">
        @foreach ($letters as $letter)
            <div class="mb-6 p-4 border rounded {{ $letter->id % 2 == 0 ? 'bg-gray-100' : 'bg-gray-200' }}">
                <h1 class="text-2xl font-bold mb-4">{{ $letter->title }}</h1>
                <p class="mb-6 text-gray-700">{{ $letter->body }}</p>
                <p class="text-sm text-gray-500">Posted by {{ $letter->user->name ?? 'Anonymous' }} on {{ $letter->created_at->format('F j, Y') }}</p>
                
                <!-- Link to show more details -->
                <a href="{{ route('letters.show', $letter->id) }}" class="text-blue-600">Read more</a>
            </div>
        @endforeach
    </div>

    <!-- Pagination Controls -->
    <div class="mt-6">
        {{ $letters->links() }}
    </div>
</div>
@endsection
