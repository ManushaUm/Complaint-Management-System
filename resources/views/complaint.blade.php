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


                                    <p class="card-title-desc">Complaint Status</p>
                                    <form action="{{ route('complaintstatus.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Category</label>
                                            <div class="col-md-3">
                                                <select class="form-select" id='category' name='category'>
                                                    <option>Motor Claims</option>
                                                    <option>Non Motor Claims</option>
                                                    <option>Policy Serving</option>
                                                    <option>Motor Underwriting</option>
                                                    <option>Non Motor Underwriting</option>
                                                    <option>Marketing & Sales</option>
                                                    <option>Premium</option>
                                                    <option>Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Sub Category</label>
                                            <div class="col-md-3">
                                                <select class="form-select" id='subcategory' name='subcategory'>
                                                    <option>Motor Claims</option>
                                                    <option>Non Motor Claims</option>
                                                    <option>Policy Serving</option>
                                                    <option>Motor Underwriting</option>
                                                    <option>Non Motor Underwriting</option>
                                                    <option>Marketing & Sales</option>
                                                    <option>Premium</option>
                                                    <option>Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="location-input" class="col-md-2 col-form-label">Location</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" placeholder="location"
                                                    id="location" name="location">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="branch-input" class="col-md-2 col-form-label">Branch</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" placeholder="Branch" id="branch" name="branch">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="resperson-input" class="col-md-2 col-form-label">Responsible Person</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" value="" placeholder="Responsible Person's Name"
                                                    id="resperson" name="resperson">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="altperson-input" class="col-md-2 col-form-label">Alternative Person</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" value="" placeholder="Alternative Person's Name"
                                                    id="altperson" name="altperson">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="pred-input" class="col-md-2 col-form-label">Predefined Text</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" value="" placeholder=""
                                                    id="pred" name="pred">
                                            </div>
                                        </div>
                                        <div class="mb-4 row">
                                            <label for="description-textarea" class="col-md-2 col-form-label">Description of the complaint</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" value="" placeholder="Enter the description of the complaint"
                                                    id="description" rows="5" name="description">
                                            </div>
                                        </div>
                                        <!--submit button layout-->
                                        <div class='col-sm-6'>
                                            <div>
                                                @csrf
                                                <button type="submit" class="btn btn-primary w-md" onclick="alert('done')">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div> <!-- end col -->
                            </div>

                        </div>


                    </div>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



        </body>
    </div>
</x-app-layout>