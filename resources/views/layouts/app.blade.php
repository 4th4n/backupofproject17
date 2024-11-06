<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiosk Ordering System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Add this in the <head> section of layouts/app.blade.php -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- Custom Styles -->
    <style>
        body {
            max-width: 100%; /* Allow the container to take the full width */
            padding: 0 15px; /* Add some padding */
        }
        
        /* Navbar Styles */
        .navbar {
            background-color: #f0f4f8;
            padding: 0.5rem 1rem;
            width: 100%; /* Ensure navbar takes full width */
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ffc107;
        }

        .nav-link {
            color: #333 !important; /* Changed to a visible color */
            font-weight: bold;
        }

        .nav-link:hover {
            color: #ffc107 !important;
        }

        /* Responsive Search Container */
        .search-container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            max-width: 100%;
        }

        .search-input-group {
            display: flex;
            align-items: center;
            border-radius: 30px;
            background-color: #fff;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0.2rem 0.5rem;
            max-width: 400px;
            width: 100%;
            height: 40px;
        }

        .search-input-group input {
            border: none;
            outline: none;
            box-shadow: none;
            flex-grow: 1;
            font-size: 1rem;
            height: 100%;
        }

        .search-input-group .icon-btn {
            background: none;
            border: none;
            color: #666;
            font-size: 1.2rem;
        }

        .search-input-group .search-mic-btn {
            background-color: #f0f0f0;
            border-radius: 50%;
            padding: 1%;
            margin-left: 10px;
        }

        /* Offcanvas Menu Customizations */
        .custom-offcanvas-bg {
            background-color: black;
            color: white;
        }

        .custom-offcanvas .nav-link {
            color: white !important;
            font-weight: bold;
        }

        .custom-offcanvas .nav-link:hover {
            color: #cccccc !important;
        }

        .custom-offcanvas .nav-link.active {
            color: #ffcc00 !important;
        }
        
        /* Footer */
        .footer {
            background-color: #f8f9fa;
            text-align: center;
            margin-top: auto; /* Ensures footer stays at bottom */
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .navbar {
                padding: 0.2rem 0.5rem;
            }

            .search-container {
                max-width: 80%;
            }

            .search-input-group {
                max-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .search-container {
                max-width: 100%;
            }
        }

        /* Custom style for black navbar-toggler-icon */
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba(0, 0, 0, 1)' stroke-width='3' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
    </style>
</head>
<body>
  
    <div class="offcanvas offcanvas-start custom-offcanvas custom-offcanvas-bg" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
      
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/') }}">Home</a>
                </li>
        </div>
    </div>
   
    <!-- Main Content -->
    <main class="container-fluid mt-4 flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container-fluid">
            <span class="text-muted">&copy; {{ date('Y') }} Kiosk Ordering System</span>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 