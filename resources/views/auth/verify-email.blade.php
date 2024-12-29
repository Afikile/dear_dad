@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold mb-6 text-center">Verify Your Email Address</h1>

    <p class="text-gray-700 mb-4 text-center">Before proceeding, please check your email for a verification link. If you did not receive the email, click the button below to request another one.</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button 
            type="submit" 
            class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300"
        >
            Resend Verification Email
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Back to Login</a>
    </div>
</div>
@endsection
