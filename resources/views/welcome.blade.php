<!doctype html>
<html lang="en">

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

<body data-sidebar="dark">


    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="assets/images/CI-logo.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/CI-logo.png" alt="" height="17">
                            </span>
                        </a>

                        <a href="index.html" class="logo logo-light">
                            <span>
                                <h2>Logo space</h2>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="bx bx-search-alt"></span>
                        </div>
                    </form>

                    <!-- User Actions -->
                    <div class="user-actions">
                        <ul class="nav navbar-nav navbar-right">
                            <li>

                                <ul class=>
                                    <li><a href="{{ route('login') }}"><i class="bx bx-log-in"></i> Login</a></li>
                                    <li><a href="/register" class="dropdown-item"><i class="bx bx-user-plus"></i> Register</a></li>
                                </ul>

                            </li>
                        </ul>
                    </div>


        </header>


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

</html>