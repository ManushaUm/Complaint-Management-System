<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>CI Lanka - Complaint Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="../../../assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap-->
    <link href="../../../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- Icons-->
    <link href="../../../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App-->
    <link href="../../../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery and Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="../../../assets/libs/select2/js/select2.min.js"></script>
    <script src="../../../assets/js/pages/form-advanced.init.js"></script>

    <!-- Plugins css -->
    <link href="../../../assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />


</head>

<body class="font-sans antialiased" data-sidebar="dark">

    <div class="min-h-screen bg-gray-300 d-flex flex-column">

        <!-- Fixed Topbar -->
        <header class="bg-gray-100 shadow fixed-top w-100">
            <div class="mx-auto sm:px-6 lg:px-8">
                @include('layouts.topbar')
            </div>
        </header>

        <div>

            <nav class="bg-gray-100 shadow">
                @include('layouts.navbar')
            </nav>

            <!-- Page Content -->

<main class="bg-gray-200 flex-grow-1" style="margin-left: 250px; padding: 108px 20px 20px 20px; position: relative;">
                @isset($header)
                <header class="bg-gray-100 shadow">
                    <div class="px-2 py-6 mx-auto max-w-7xl sm:px-4 lg:px-6">
                        {{ $header }}
                    </div>
                </header>
                @endisset
<!-- Add Breadcrumbs Section (Full Width) -->
                <div class="page-title-box d-flex align-items-center justify-content-between" style="position: absolute; top: 75px; left: 0; right: 0; z-index: 10;">
                    <div class="card" style="width: 100%;">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <!-- Optional: Page Title -->
                            <h4 class="mb-0 font-size-18">{{ Route::current()->getName() }}</h4>
                            @if (Breadcrumbs::exists(Route::current()->getName()))
                                <nav aria-label="breadcrumb">
                                    {{ Breadcrumbs::render() }}
                                </nav>
                            @endif
                        </div>
                    </div>
                </div>
                {{ $slot }}

            </main>
        </div>
    </div>

</body>

<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Proud product by <span><a href="https://github.com/ManushaUm">Seeds.co</a>
                </div>
            </div>
        </div>
    </div>
</footer>


</html>