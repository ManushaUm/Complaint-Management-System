<x-app-layout>

    <head>
        <meta charset="utf-8" />
        <title>CI Lanka - Complaint Management System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/CI-logo.png">

        <!-- Bootstrap-->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons-->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    </head>


    <x-slot name="header">
        <x-user-profile />

    </x-slot>
    <main>

        <x-vertical-nav-tab :departments="$departments" :divisionsData="$divisionsData" />

    </main>

</x-app-layout>