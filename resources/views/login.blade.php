<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Form Layouts | Skote - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />


</head>

<body data-sidebar="dark">


    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- ========== Login Card ========== -->

        <div class="main-content">

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Login</h4>

                        <form>

                            <div class="row mb-4">
                                <label for="horizontal-email-input" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="horizontal-email-input" placeholder="Enter Your Email">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="horizontal-password-input" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="horizontal-password-input" placeholder="Enter Your Password">
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-9">

                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" id="horizontalLayout-Check">
                                        <label class="form-check-label" for="horizontalLayout-Check">
                                            Remember me
                                        </label>
                                    </div>

                                    <div>
                                        <!-- Write the login req here -->
                                        <form action="{{ route('/') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- end main content-->

    </div>



</body>

</html>