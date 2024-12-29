@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold mb-6 text-center">Login</h1>

    {{-- Flash message for errors --}}
    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

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
                placeholder="Enter your password" 
                required
            >
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4 flex items-center justify-between">
            <label for="remember" class="inline-flex items-center">
                <input 
                    type="checkbox" 
                    name="remember" 
                    id="remember" 
                    class="form-checkbox"
                >
                <span class="ml-2 text-gray-600">Remember Me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">
                    Forgot Password?
                </a>
            @endif
        </div>

        <button 
            type="submit" 
            class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300"
        >
            Login
        </button>
    </form>

    <div class="mt-6 text-center">
        <span class="text-gray-600">Don't have an account?</span>
        <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a>
    </div>
</div>
@endsection
