<x-app-layout>

    <head>
        <meta charset="utf-8" />
        <title>CI Lanka - Complaint Management System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/CI-logo.png">

        <!-- Bootstrap-->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Icons-->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    </head>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-400 leading-tight">
            View complaints
        </h2>
    </x-slot>

    <div class="py-12">

        <body data-sidebar="dark">
            @auth
            <div id="layout-wrapper">
                <!-- New complaint table-->
                @if(Session('role')=='admin')
                <div class="container-fluid">
                    <div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title mb-4">New Complaints</h4>
                                                        <div class="table-responsive">
                                                            <table class="table align-middle table-nowrap mb-0">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>Customer</th>

                                                                        <th>Contact No</th>
                                                                        <th>Email</th>
                                                                        <th>Customer Type</th>
                                                                        <th>Policy/Vehicle Number</th>
                                                                        <th>Complaint Date</th>


                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($complaints as $complaint)
                                                                    <tr>
                                                                        <td>{{ $complaint->name }}</td>

                                                                        <td>{{ $complaint->contact_no }}</td>
                                                                        <td>{{ $complaint->email }}</td>
                                                                        <td>{{ $complaint->customer_type }}</td>
                                                                        <td>{{ $complaint->policy_number }}</td>
                                                                        <td>{{ $complaint->complaint_date }}</td>


                                                                        <td>
                                                                            <!-- Button trigger modal -->
                                                                            <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#transaction-detailModal"
                                                                                data-complaint='@json($complaint)'>
                                                                                View Details
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                        <!-- end table-responsive -->

                                                        <!-- Transaction Modal -->
                                                        <x-complaint-assign-modal :departmentNames="$departmentNames" />

                                                        <!-- end modal -->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div>
                </div>
                @endif

            </div>
            @endauth

        </body>
    </div>
</x-app-layout>