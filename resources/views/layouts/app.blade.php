<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>CI Lanka - Complaint Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Stylesheets -->
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen bg-gray-100">

    <!-- Topbar -->
    <header class="bg-gray-100 shadow w-full fixed top-0 z-50">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            @include('layouts.topbar')
        </div>
    </header>

    <!-- Spacer for fixed header -->
    <div class="h-16"></div>

    <!-- Navbar / Sidebar -->
    <nav class="bg-gray-200 shadow">
        @include('layouts.navbar')
    </nav>

    <!-- Main Content -->
    <main class="flex-grow bg-slate-100 p-6">
        <div class="container mx-auto">
            @yield('')
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t py-4 mt-auto">
        <div class="container-fluid px-4">
            <div class="row">
                <div class="col-sm-6">
                    <!-- Left footer content if any -->
                </div>
                <div class="col-sm-6 text-end text-muted text-sm">
                    Proud product by <a href="https://github.com/ManushaUm" class="text-decoration-underline">Seeds.co</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>

</html>