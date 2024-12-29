@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-3xl font-bold mb-6 text-center">Welcome to Your Dashboard</h1>

    <div class="space-y-6">
        <!-- User Information -->
        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
            <h2 class="text-xl font-semibold">Your Profile</h2>
            <p class="text-gray-700 mt-2">View and update your personal information below:</p>
            <div class="mt-4">
                <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:underline">Edit Profile</a>
            </div>
        </div>

        <!-- Letters Section -->
        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
            <h2 class="text-xl font-semibold">Your Letters</h2>
            <p class="text-gray-700 mt-2">View and manage the letters you have written:</p>
            <div class="mt-4">
                <a href="{{ route('letters.create') }}" class="text-blue-600 hover:underline">Write a New Letter</a>
            </div>
            <div class="mt-4">
                <a href="{{ route('letters.index') }}" class="text-blue-600 hover:underline">View All Letters</a>
            </div>
        </div>

        <!-- Notifications -->
        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
            <h2 class="text-xl font-semibold">Notifications</h2>
            <p class="text-gray-700 mt-2">Stay up to date with the latest updates and events:</p>
            <div class="mt-4">
                <!-- Example: You can display notification messages here -->
                <p class="text-sm text-gray-600">No new notifications.</p>
            </div>
        </div>
    </div>
</div>
@endsection
