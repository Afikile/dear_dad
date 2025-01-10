<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dear Dad')</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Main layout styling for sticky footer */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: #f7f7f7;
            color: #333;
        }

        main {
            flex: 1; /* Push footer to the bottom */
        }

        nav {
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: #fff;
        }

        .navbar-nav .nav-item .nav-link {
            color: #fff;
            font-weight: 600;
        }

        .navbar-nav .nav-item .nav-link:hover {
            color: #f1f1f1;
            text-decoration: underline;
        }

        .btn-logout {
            background: #ff4757;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            transition: background 0.3s ease;
        }

        .btn-logout:hover {
            background: #ff6b81;
        }

        .list-group-item {
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .list-group-item:hover {
            transform: scale(1.05);
        }

        .container {
            margin-top: 30px;
        }

        .list-group-item strong {
            color: #6c5ce7;
        }

        footer {
            background-color: #2d3436;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        /* Dark Mode */
        .dark-mode {
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        /* Styling for the logo */
        .navbar-brand img {
            height: 50px; /* Increased size of the logo */
            width: auto; /* Maintain aspect ratio */
        }

        .navbar-brand {
            padding: 0; /* Remove padding around the logo */
        }
    </style>
</head>
<body class="light-mode">

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <!-- Logo only (no text) -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo"> <!-- Logo without text -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-logout">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Dear Dad. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Dark Mode
        function toggleDarkMode() {
            const body = document.body;
            body.classList.toggle("dark-mode");
        }
    </script>
</body>
</html>
