@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Letters</h1>

    <!-- Success message for letter actions -->
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error message for unauthorized actions -->
    @if (session('error'))
        <div class="bg-red-500 text-white p-4 mb-4 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Information message for empty replies -->
    @if (session('info'))
        <div class="bg-yellow-500 text-white p-4 mb-4 rounded-lg">
            {{ session('info') }}
        </div>
    @endif

    <!-- Button to create a new letter -->
    <div class="mb-4">
        <a href="{{ route('letters.create') }}" class="inline-block bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700">
            Write a New Letter
        </a>
    </div>

    <!-- Display logged-in username -->
    <div class="mb-4">
        @auth
            <p class="text-lg font-semibold text-gray-800">Welcome, {{ auth()->user()->username ?? 'Anonymous' }}!</p>
        @endauth
        @guest
            <p class="text-lg font-semibold text-gray-800">Welcome, Guest!</p>
        @endguest
    </div>

    <!-- Letter List with Space for Ads -->
    <div class="flex space-x-6">
        <!-- Left Column for Letters -->
        <div class="w-3/4 space-y-4">
            @foreach($letters as $index => $letter)
                <!-- Display only the logged-in user's letters -->
                @if($letter->user_id == auth()->id())
                    <div class="p-4 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition duration-200 {{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-gray-200' }}">
                        <h2 class="text-xl font-semibold text-gray-800">
                            <a href="{{ route('letters.show', $letter->id) }}" class="hover:text-indigo-600">{{ $letter->title }}</a>
                        </h2>
                        <p class="text-gray-600 mt-2">{{ Str::limit($letter->body, 150) }}</p>
                        <div class="flex items-center justify-between mt-4">
                            <p class="text-sm text-gray-500">
                                Written by {{ $letter->user->username ?? 'Anonymous' }} on {{ $letter->created_at->format('M d, Y') }}
                                @if($letter->view_count) • Views: {{ $letter->view_count }} @endif
                            </p>

                            <!-- Thumbnail with the number of replies -->
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center text-xs">
                                    {{ $letter->replyCount() }}
                                </div>
                                <span class="text-sm text-gray-500">Replies</span>
                            </div>

                            <div class="flex space-x-2">
                                <!-- Edit and Delete buttons -->
                                <a href="{{ route('letters.edit', $letter->id) }}" class="text-indigo-600 hover:text-indigo-800">Edit</a>
                                <form action="{{ route('letters.destroy', $letter->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this letter?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                                
                                <!-- Push Up button -->
                                @if(Auth::id() == $letter->user_id)
                                    <form action="{{ route('letters.pushUp', $letter->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-800">Push Up</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Right Column for Ads (2 ads) -->
        <div class="w-1/4 space-y-6">
            <!-- First Ad -->
            <div class="bg-gray-200 p-6 rounded-lg h-80 overflow-hidden">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Advertisement 1</h2>
                <div class="flex flex-col items-center">
                    <img src="https://via.placeholder.com/300x200" alt="Ad Image" class="mb-4 w-full h-48 object-cover">
                    <p class="text-gray-600 text-center">Place your ad content here, like images and text.</p>
                </div>
            </div>

            <!-- Second Ad -->
            <div class="bg-gray-200 p-6 rounded-lg h-80 overflow-hidden">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Advertisement 2</h2>
                <div class="flex flex-col items-center">
                    <img src="https://via.placeholder.com/300x200" alt="Ad Image" class="mb-4 w-full h-48 object-cover">
                    <p class="text-gray-600 text-center">Place your ad content here, like images and text.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $letters->links('pagination::tailwind') }}
    </div>
</div>
@endsection
