<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f7f7f7;
            color: #333;
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

        .footer {
            background-color: #2d3436;
            padding: 20px;
            color: #fff;
            text-align: center;
        }

        /* Dark Mode */
        .dark-mode {
            background-color: #2c3e50;
            color: #ecf0f1;
        }
    </style>
</head>
<body class="light-mode">

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">My App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('letters.index') }}">Dashboard</a>
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

    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="footer">
        <p>&copy; 2025 My App. All Rights Reserved.</p>
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
