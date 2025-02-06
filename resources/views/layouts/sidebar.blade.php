<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Sweetalert -->
<script src="{{ asset('js/sweetalert.js') }}"></script>

</head>

<body class="font-sans antialiased">
<div>
<!-- Sidebar -->
<aside>
<!--logo -->
<div>
<div>
<a href="">
<x-application-logo class="block w-auto h-10 text-gray-600 fill-current"/>
</a>
<span>CI Lanka</span>
</div>
<button>
<svg xmlns="http://www.w3.org/2000/svg" class="block w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
</svg>
</button>
</div>

<!--Nav links -->
<nav>
</nav>

</aside>
<!--Main content -->
<main>
<nav></nav>
<div>
{{ $slot }}
</div>
</main>
</div>

</body>

</html>