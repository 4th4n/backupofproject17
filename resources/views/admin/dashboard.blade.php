<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        /* Offcanvas menu styling */
        .custom-offcanvas-bg {
            background-color: #212529;
            color: #adb5bd;
        }
        .custom-offcanvas-bg .offcanvas-title {
            font-weight: bold;
            font-size: 1.25rem;
            color: #ffffff;
        }
        .custom-offcanvas-bg .nav-link {
            color: #adb5bd;
            font-weight: 500;
        }
        .custom-offcanvas-bg .nav-link:hover {
            color: #ffffff;
        }

        /* Navbar and main content styling */
        .navbar {
            background-color: #212529;
            border-bottom: 2px solid #343a40;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* Main content styling */
        main {
            background-color: #f8f9fa;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #343a40;
            font-weight: bold;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
        }

        /* Button styles */
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="navbar-brand mb-0 h1">Admin Dashboard</span>
        </div>
    </nav>

    <!-- Offcanvas Menu -->
    <div class="offcanvas offcanvas-start custom-offcanvas-bg" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('items.index') }}">List of Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.view') }}">List Orders</a>
                </li>
                <!-- Add Item Button (Uncomment if needed) -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('items.create') }}">Add Item</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                       Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container my-4">
       
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
