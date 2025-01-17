<x-app-layout>

    <head>
        <meta charset="utf-8" />
        <title>CI Lanka - Complaint Management System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/CI-logo.png">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>
    <div class="py-12">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Search Complaints
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Outer Container -->
            <div class="bg-gray-50 p-8 shadow-lg rounded-lg border border-gray-200">
    

        <div class="row">
        <div class="col-9">
            <!-- Card-like container -->
            <div class="">
            
                <form action="{{ route('search.complaints') }}" method="GET">
                    @csrf
                    <div class="mb-3 row">
                        <label for="customer_name" class="col-md-2 col-form-label">Customer Name</label>
                        <div class="col-md-7">
                            <input type="text" name="customer_name" id="customer_name" 
                                   class="form-control" placeholder="Enter customer name">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="policy_number" class="col-md-2 col-form-label">Policy/Vehicle Number</label>
                        <div class="col-md-7">
                            <input type="text" name="policy_number" id="policy_number" 
                                   class="form-control" placeholder="Enter policy or vehicle number">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="complaint_date" class="col-md-2 col-form-label">Complaint Date</label>
                        <div class="col-md-7">
                            <input type="date" name="complaint_date" id="complaint_date" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-7">
                            <input type="email" name="email" id="email" 
                                   class="form-control" placeholder="Enter email address">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-3 row">
                        <div class="col-md-2"></div>
                        <div class="col-md-7">
                            <button type="submit" class="btn btn-outline-primary w-md">Search</button>
                        </div>
                    </div>
                </form>

                <!-- Results Section -->
                @if(isset($complaints))
                <div class="mt-8">
                    <div class="overflow-x-auto">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Customer</th>
                                    <th>Policy Number</th>
                                    <th>Date</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($complaints as $comp)
                                    <tr>
                                        <td>{{ $comp->id }}</td>
                                        <td>{{ $comp->name }}</td>
                                        <td>{{ $comp->insured ? 'Yes' : 'No' }}</td>
                                        <td>{{ $comp->contact_no }}</td>
                                        <td>{{ $comp->email }}</td>
                                        <td>
                                            <a href="{{ route('full.complaint', ['id' => $comp->id]) }}" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
        </div>
        </div>
   
    </div>
</div>
        </body>
    </div>

    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="assets/js/pages/form-validation.init.js"></script>

    <script src="assets/js/app.js"></script>

    <script src="assets/libs/select2/js/select2.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
    <script src="assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>

    <!-- form advanced init -->
    <script src="assets/js/pages/form-advanced.init.js"></script>
</x-app-layout>