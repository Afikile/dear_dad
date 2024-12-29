@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold mb-6 text-center">Edit Letter</h1>

    {{-- Flash message for success --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- Flash message for errors --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('letters.update', $letter->id) }}">
        @csrf
        @method('PUT')

        <!-- Title Field -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                value="{{ old('title', $letter->title) }}" 
                class="w-full p-2 border rounded" 
                placeholder="Enter the letter's title" 
                required
            >
        </div>

        <!-- Body Field -->
        <div class="mb-4">
            <label for="body" class="block text-gray-700 font-bold mb-2">Body</label>
            <textarea 
                id="body" 
                name="body" 
                class="w-full p-2 border rounded" 
                placeholder="Write the content of the letter here..." 
                rows="5" 
                required
            >{{ old('body', $letter->body) }}</textarea>
        </div>

        <button 
            type="submit" 
            class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300"
        >
            Save Changes
        </button>
    </form>
</div>
@endsection
