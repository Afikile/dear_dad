@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Write a New Letter</h1>

    <form action="{{ route('letters.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <!-- Title Input -->
        <div class="mb-6">
            <label for="title" class="block text-gray-800 font-bold mb-2">Title</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" 
                placeholder="Enter a title for your letter" 
                value="{{ old('title') }}" 
                required
            >
            @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Body Input -->
        <div class="mb-6">
            <label for="body" class="block text-gray-800 font-bold mb-2">Body</label>
            <textarea 
                id="body" 
                name="body" 
                class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" 
                placeholder="Write your letter here..." 
                rows="6" 
                required
            >{{ old('body') }}</textarea>
            @error('body')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Allow Comments Checkbox -->
        <div class="mb-6 flex items-center">
            <input 
                type="checkbox" 
                id="allow_comments" 
                name="allow_comments" 
                class="mr-2" 
                {{ old('allow_comments') ? 'checked' : '' }}
            >
            <label for="allow_comments" class="text-gray-800 font-bold">Allow comments on this letter?</label>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button 
                type="submit" 
                class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300"
            >
                Submit Letter
            </button>
        </div>
    </form>
</div>
@endsection
