@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Display Success Message -->
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Original Post -->
    <div class="mb-6 p-4 border rounded {{ $letter->id % 2 == 0 ? 'bg-gray-100' : 'bg-gray-200' }}">
        <h1 class="text-2xl font-bold mb-4">{{ $letter->title }}</h1>
        <p class="mb-6 text-gray-700">{{ $letter->body }}</p>
        <p class="text-sm text-gray-500">Posted by {{ $letter->user->name ?? 'Anonymous' }} on {{ $letter->created_at->format('F j, Y') }}</p>
    </div>

    <!-- Display Replies Thumbnail and Number of Replies -->
    <div class="flex items-center mt-6">
        <div class="w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center text-xs">
            {{ $letter->replies->count() }} <!-- Use replies count directly from the relationship -->
        </div>
        <span class="text-sm text-gray-500 ml-2">Replies</span>
    </div>

    <!-- Display Existing Replies -->
    <div class="mt-8">
        <h2 class="text-xl font-bold mb-4">Replies</h2>
        @if ($replies->isEmpty()) <!-- Check if replies collection is empty -->
            <p class="text-gray-600">No replies yet. Be the first to reply!</p>
        @else
            @foreach ($replies as $reply)
                @include('replies.partials.reply', ['reply' => $reply]) <!-- Include the reply partial -->
            @endforeach
        @endif
    </div>

    <!-- Reply Form for the Original Post -->
    @auth
    <form action="{{ route('replies.store', $letter->id) }}" method="POST" class="mt-6">
        @csrf
        <label for="reply" class="block text-gray-700 font-bold mb-2">Your Reply</label>
        <textarea 
            id="reply" 
            name="body" 
            class="w-full p-2 border rounded" 
            placeholder="Write your reply here..." 
            rows="3" 
            required
        >{{ old('body') }}</textarea>

        <!-- Display validation error for 'body' -->
        @error('body')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror

        <button 
            type="submit" 
            class="bg-blue-600 text-white px-4 py-2 rounded mt-2 hover:bg-blue-700 transition duration-300"
        >
            Submit Reply
        </button>
    </form>
    @else
        <p class="text-gray-600 mt-6">You must <a href="{{ route('login') }}" class="text-blue-500">log in</a> to reply.</p>
    @endauth
</div>
@endsection
