@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">All Letters</h1>

    @foreach($letters as $letter)
        <div class="border border-gray-300 rounded-lg p-4 mb-4">
            <h2 class="text-xl font-bold">{{ $letter->title }}</h2>
            <p class="text-gray-700 mb-2">{{ $letter->content }}</p>
            <p class="text-sm text-gray-500">By {{ $letter->user->name }} on {{ $letter->created_at->format('M d, Y') }}</p>

            @if(auth()->id() === $letter->user_id)
                <!-- Show Edit and Delete options only for the author -->
                <div class="mt-2">
                    <a href="{{ route('letters.edit', $letter) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('letters.destroy', $letter) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            @endif
        </div>
    @endforeach
</div>
@endsection
