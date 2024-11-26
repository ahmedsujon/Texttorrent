<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-bg {
            background: linear-gradient(to right, #e2e8f0, #e5e7eb);
        }

        .custom-btn:hover {
            background-color: #f3e8ff !important;
            transition: background-color 0.3s ease-in-out;
        }

        @media (prefers-color-scheme: dark) {
            .custom-bg {
                color: #111111 !important;
            }

            .custom-btn {
                background-color: #000000 !important;
                color: #ffffff !important;
            }

            .custom-btn:hover {
                background-color: #4b5563 !important;
            }
        }
    </style>
</head>

<body>
    <div class="custom-bg text-dark">
        <div class="d-flex align-items-center justify-content-center min-vh-100 px-2">
            <div class="text-center">
                <h1 class="display-1 fw-bold">404</h1>
                <p class="fs-2 fw-medium mt-4">Oops! Page not found</p>
                <p class="mt-4 mb-5">The page you're looking for doesn't exist or has been moved.</p>
                <p>@yield('message')</p>
                <a href="{{ route('admin.dashboard') }}"
                    class="btn btn-light fw-semibold rounded-pill px-4 py-2 custom-btn">
                    Go Home
                </a>
            </div>
        </div>
    </div>
</body>

</html>
