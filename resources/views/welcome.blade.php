<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>CI - Lanka complaint management portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Skote - Premium Multipurpose Admin Dashboard Template built with bootstrap v5.1.3. in HTML and Laravel 9.0 version" name="description" />
    <meta name="keywords" content="Skote admin template, admin template, Responsive admin template, crm, cms, project management apps, bootstrap admin template" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Sarabun:400,500,600,700|Rubik:300,400,500" rel="stylesheet">

    <!-- Material Icon -->
    <link rel="stylesheet" type="text/css" href="../../cdn.jsdelivr.net/npm/%40mdi/font%404.7.95/css/materialdesignicons.min.css" />
    <!-- Bootstrap Css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <!-- Custom Css -->
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="css/colors/red.css">

    <style>
        /* Full-screen background section */
        .bg-home {
            height: 100vh;
            background-image: url('images/bg-home.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        /* Full overlay effect */
        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Adjust opacity as needed */
            z-index: 1;
        }

        /* Ensure content sits above overlay */
        .container-fluid {
            position: relative;
            z-index: 2;
        }
    </style>

</head>

<body data-spy="scroll" data-target="#data-scroll" data-hijacking="on" data-animation="scaleDown">

    <body data-sidebar="dark">

        <!--START HOME-->
        <section class="section bg-home home-half" id="home">
            <div class="bg-overlay"></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 text-white text-center">
                        <h4 class="home-small-title">Complaint Management Portal</h4>
                        <h1 class="home-title font-weight-light"><b>CI - Lanka</b></h1>
                        <p class="padding-t-15 home-desc mx-auto">Centralized system for customer complaint management.</p>

                        <p class="margin-t-30 mb-5">
                            <a href="{{route('register')}}" target="_blank" class="btn btn-custom waves-effect waves-light"><i class="mdi mdi-cart mr-2"></i> Sign Up</a>
                            <a href="{{route('login')}}" target="_blank" class="btn btn-custom waves-effect waves-light"><i class="mdi mdi-cart mr-2"></i> Sign In</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!--END HOME-->

    </body>

</html>