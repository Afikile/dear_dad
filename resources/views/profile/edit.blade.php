@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Profile</h1>

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PATCH') <!-- Using PATCH for the form -->

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ auth()->user()->name }}" required>
        </div>

        <!-- Surname -->
        <div class="mb-4">
            <label for="surname" class="block text-gray-700">Surname</label>
            <input type="text" name="surname" id="surname" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ auth()->user()->surname }}" required>
        </div>

        <!-- Username -->
        <div class="mb-4">
            <label for="username" class="block text-gray-700">Username</label>
            <input type="text" name="username" id="username" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ auth()->user()->username }}" required>
        </div>

        <!-- Email (Disabled field) -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded-lg" value="{{ auth()->user()->email }}" disabled>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Update Profile</button>
    </form>
</div>
@endsection
