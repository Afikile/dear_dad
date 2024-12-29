@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold mb-6 text-center">Confirm Your Password</h1>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                required 
                class="w-full p-2 border rounded"
                placeholder="Enter your password"
            >
            @error('password')
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>

        <button 
            type="submit" 
            class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300"
        >
            Confirm Password
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">Go Back to Dashboard</a>
    </div>
</div>
@endsection
