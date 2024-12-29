<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dear Dad')</title>
    <!-- Add your stylesheet here -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Add any other required assets here -->
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex flex-col">
        <!-- Navigation Bar -->
        <nav class="bg-blue-500 text-white p-4">
            <div class="container mx-auto flex justify-between items-center">
                <a href="/" class="text-xl font-bold">Dear Dad</a>
                <div>
                    <a href="{{ route('letters.index') }}" class="mx-4">Home</a>
                    <a href="{{ route('letters.create') }}" class="mx-4">Write a Letter</a>
                    @auth
                            <a href="{{ route('dashboard') }}" class="mx-4">Dashboard</a>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Logout</button>
                            </form>
                            <span class="mx-4 font-bold">{{ Auth::user()->username }}</span> <!-- Display username -->
                        @else
                            <a href="{{ route('login') }}" class="mx-4">Login</a>
                            <a href="{{ route('register') }}" class="mx-4">Register</a>
                        @endauth
                        
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow container mx-auto py-8">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white p-4 text-center">
            <p>&copy; 2024 Dear Dad. All rights reserved.</p>
        </footer>
    </div>

</body>
</html>
