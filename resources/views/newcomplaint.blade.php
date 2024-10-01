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
            <h4 class="card-title">Welcome {{ Auth::user()->name }} </h4>
        </h2>
    </x-slot>

    <div class="py-12">

        <body data-sidebar="light">


            <!-- Begin page -->
            <div id="layout-wrapper">


                <div class="main-content">
                    <div class="row">
                        <div class="col-9">
                            <!-- If need to implement as card use as card class  -->
                            <div class="">
                                <!-- class - card-body  -->
                                <div class="">


                                    <p class="card-title-desc">Lodge new complaint</p>

                                    <div class="mb-3 row">
                                        <label for="name-input" class="col-md-2 col-form-label">Name</label>
                                        <div class="col-md-7">
                                            <input class="form-control" type="text" placeholder="User Name"
                                                id="name-input">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-md-2 col-form-label">Insured?</label>
                                        <div class="col-md-2">
                                            <select class="form-select">
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>

                                        <label for="relation-input" class="col-md-1 col-form-label">Relation</label>
                                        <div class="col-md-4">
                                            <input class="form-control" type="text" placeholder="If No, enter the relation" id="relation-input">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="address-input" class="col-md-2 col-form-label">Address</label>
                                        <div class="col-md-7">
                                            <input class="form-control" type="text" value="" placeholder="Enter address"
                                                id="address-input">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="contact-input" class="col-md-2 col-form-label">Contact no</label>
                                        <div class="col-md-7">
                                            <input class="form-control" type="tel" value="" placeholder="Enter contact number"
                                                id="contact-input">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="email-input" class="col-md-2 col-form-label">Email</label>
                                        <div class="col-md-7">
                                            <input class="form-control" type="email" value="" placeholder="Enter email"
                                                id="email-input">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-2 col-form-label">Select</label>
                                        <div class="col-md-3">
                                            <select class="form-select">
                                                <option>walking customer</option>
                                                <option>direct call</option>
                                                <option>customer hotline</option>
                                                <option>branch</option>
                                                <option>web</option>
                                                <option>Email/Letters</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="policy-number-input" class="col-md-2 col-form-label">Vehicle / Policy number</label>
                                        <div class="col-md-7">
                                            <input class="form-control" type="text" value="" placeholder="Enter the Insurence policy number"
                                                id="policy-number-input">
                                        </div>
                                    </div>


                                    <div class="mb-3 row">
                                        <label for="date-input" class="col-md-2 col-form-label">Date of complaint</label>
                                        <div class="col-md-2">
                                            <input class="form-control" type="date" value=""
                                                id="date-input">
                                        </div>
                                    </div>

                                    <div class="mb-4 row">
                                        <label for="detail-textarea" class="col-md-2 col-form-label">Detail of the complaint</label>
                                        <div class="col-md-7">
                                            <input class="form-control" type="text" value="" placeholder="Enter the brief of the complaint"
                                                id="detail-textarea" rows="5">
                                        </div>

                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <div class="mt-3">
                                                <label for="formFile" class="form-label">Attachments</label>
                                                <input class="form-control" type="file" id="formFile">
                                            </div>

                                        </div>

                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="formCheck1">
                                        <label class="form-check-label" for="formCheck1">
                                            Notify the customer
                                        </label>
                                    </div>
                                    <!--submit button layout-->
                                    <div class='col-sm-6'>
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md" onclick="alert('succeed')">Lodge</button>
                                        </div>

                                    </div>
                                </div> <!-- end col -->
                            </div>

                        </div>


                    </div>



        </body>
    </div>
</x-app-layout>