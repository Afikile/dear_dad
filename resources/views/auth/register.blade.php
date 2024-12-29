@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold mb-6 text-center">Register</h1>

    {{-- Flash message for errors --}}
    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">First Name</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name') }}" 
                class="w-full p-2 border rounded" 
                placeholder="Enter your first name" 
                required
            >
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="surname" class="block text-gray-700 font-bold mb-2">Surname</label>
            <input 
                type="text" 
                id="surname" 
                name="surname" 
                value="{{ old('surname') }}" 
                class="w-full p-2 border rounded" 
                placeholder="Enter your surname" 
                required
            >
            @error('surname')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
            <input 
                type="text" 
                id="username" 
                name="username" 
                value="{{ old('username') }}" 
                class="w-full p-2 border rounded" 
                placeholder="Choose a username" 
                required
            >
            @error('username')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email Address</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email') }}" 
                class="w-full p-2 border rounded" 
                placeholder="Enter your email" 
                required
            >
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="w-full p-2 border rounded" 
                placeholder="Create a password" 
                required
            >
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm Password</label>
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                class="w-full p-2 border rounded" 
                placeholder="Confirm your password" 
                required
            >
        </div>

        <button 
            type="submit" 
            class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300"
        >
            Register
        </button>
    </form>

    <div class="mt-6 text-center">
        <span class="text-gray-600">Already have an account?</span>
        <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
    </div>
</div>
@endsection
