@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold mb-6 text-center">Reset Your Password</h1>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email Address</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                value="{{ old('email') }}" 
                required 
                class="w-full p-2 border rounded"
                placeholder="Enter your email"
            >
            @error('email')
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">New Password</label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                required 
                class="w-full p-2 border rounded"
                placeholder="Enter a new password"
            >
            @error('password')
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm New Password</label>
            <input 
                type="password" 
                name="password_confirmation" 
                id="password_confirmation" 
                required 
                class="w-full p-2 border rounded"
                placeholder="Confirm your new password"
            >
        </div>

        <button 
            type="submit" 
            class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300"
        >
            Reset Password
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Remember your password? Login</a>
    </div>
</div>
@endsection
