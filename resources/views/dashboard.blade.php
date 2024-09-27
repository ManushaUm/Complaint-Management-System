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
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <body data-sidebar="dark">


            <!-- Begin page -->
            <div id="layout-wrapper">

                <!-- ========== Left Sidebar Start ========== -->
                <div class="vertical-menu">

                    <div data-simplebar class="h-100">

                        <!--- Sidemenu -->
                        <div id="sidebar-menu">
                            <!-- Left Menu Start -->
                            <ul class="metismenu list-unstyled" id="side-menu">
                                <li class="menu-title" key="t-menu">Menu</li>

                                <li>
                                    <a href="javascript: void(0);" class="waves-effect">
                                        <i class="bx bx-home-circle"></i><span class="badge rounded-pill bg-info float-end">04</span>
                                        <span key="t-dashboards">Dashboard</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" class="waves-effect">
                                        <i class="bx bx-list-check"></i><span class="badge rounded-pill bg-info float-end">04</span>
                                        <span key="t-dashboards">Complaints</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="index.html" key="t-default">New</a></li>
                                        <li><a href="dashboard-saas.html" key="t-saas">On going</a></li>
                                        <li><a href="dashboard-crypto.html" key="t-crypto">Completed</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                        <!-- Sidebar links and lists -->
                    </div>
                </div>
                <!-- Left Sidebar End -->


                <div class="main-content">


                </div>


            </div>



        </body>
    </div>
</x-app-layout>