<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memo Form</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Include your styles -->
</head>

<body class="bg-white">

    <div class="container ">
        <!-- Success Alert -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Memo Form -->
        @include('components.employee-notification-form')
    </div>

</body>

</html>