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
                                                        <div class="modal fade" id="transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="transaction-detailModalLabel">Complaint Details</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p class="mb-2">Date: <span class="text-primary" id="modalComplaintDate"></span></p>
                                                                        <p class="mb-4">Name: <span class="text-primary" id="modalCustomerName"></span></p>
                                                                        <p class="mb-4">Contact: <span class="text-primary" id="modalCustomerContact"></span></p>
                                                                        <p class="mb-4"><span class="text-primary" id="modalComplaintDetail"></span></p>
                                                                        <div class="table-responsive">
                                                                            <table class="table align-middle table-nowrap">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">Reference No</th>
                                                                                        <th scope="col">Attachment</th>
                                                                                        <th scope="col">Status</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td id="modalPolicyNumber"></td>
                                                                                        <td><a href="" id="modalAttachment" target="_blank">View</a></td>
                                                                                        <td id="modalStatus">
                                                                                            <span class="badge badge-pill badge-soft-warning font-size-11">Received</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                        <form>
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <h4 class="card-title">Assigining</h4>

                                                                                    <form class="needs-validation" novalidate>
                                                                                        <div class="row">



                                                                                            <div class="row">
                                                                                                <div class="col-md-6">
                                                                                                    <div class="mb-3">
                                                                                                        <label for="validationCustom03" class="form-label">Category</label>
                                                                                                        <select class="form-select" id="validationCustom03" required>
                                                                                                            <option selected disabled value="">Choose...</option>
                                                                                                            @foreach($departmentNames as $department)
                                                                                                            <option value="{{$department->id}}">{{$department->department_name}}</option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                        <div class="invalid-feedback">
                                                                                                            Please select a valid Category.
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <div class="mb-3">
                                                                                                        <label for="validationCustom04" class="form-label">Sub Category</label>
                                                                                                        <select class="form-select" id="validationCustom03" required>
                                                                                                            <option selected disabled value="">Choose...</option>
                                                                                                            <option value="Category 1">Category 1</option>
                                                                                                            <option value="Category 2">Category 2</option>
                                                                                                            <option value="Category 3">Category 3 </option>
                                                                                                        </select>
                                                                                                        <div class="invalid-feedback">
                                                                                                            Please provide a valid Sub category.
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="col-md-6">
                                                                                                    <div class="mb-3">
                                                                                                        <label for="validationCustom05" class="form-label">Location</label>
                                                                                                        <select class="form-select" id="validationCustom03" required>
                                                                                                            <option selected disabled value="">Choose...</option>

                                                                                                            <option value="Colombo">Colombo</option>
                                                                                                            <option value="Ratnapura">Ratnapura</option>
                                                                                                            <option value="Matara">Matara</option>
                                                                                                            <option value="Kandy">Kandy</option>
                                                                                                            <option value="Trincomalee">Trincomalee</option>

                                                                                                        </select>
                                                                                                        <div class="invalid-feedback">
                                                                                                            Please provide a valid Location.
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <div class="mb-3">
                                                                                                        <label for="validationCustom05" class="form-label">Branch</label>
                                                                                                        <select class="form-select" id="validationCustom03" required>
                                                                                                            <option selected disabled value="">Choose...</option>
                                                                                                            <option>...</option>
                                                                                                        </select>
                                                                                                        <div class="invalid-feedback">
                                                                                                            Please provide a valid Location.
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="mb-6">
                                                                                                    <label for="validationCustom01" class="form-label">Notes</label>
                                                                                                    <textarea type="text" class="form-control" id="validationCustom01"
                                                                                                        placeholder="Add notes for review" value=""> </textarea>
                                                                                                    <div class="valid-feedback">

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div>
                                                                                                <button class="btn btn-warning" type="submit">Assign</button>
                                                                                            </div>

                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
                <!-- Assigned Table Card -->
                @if(Session('role') == 'admin'||Session('role') == 'member')
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
                                                        <h4 class="card-title mb-4">Assigned Complaints</h4>
                                                        <div class="table-responsive">
                                                            <table class="table align-middle table-nowrap mb-0">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>Policy Number</th>
                                                                        <th>Contact No</th>
                                                                        <th>Department</th>
                                                                        <th>Division</th>
                                                                        <th>Complaint Date</th>
                                                                        <th>Status</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($assignedComplaints as $complaint)
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
                                                        <div class="modal fade" id="transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="transaction-detailModalLabel">Complaint Details</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p class="mb-2">Date: <span class="text-primary" id="modalComplaintDate"></span></p>
                                                                        <p class="mb-4">Name: <span class="text-primary" id="modalCustomerName"></span></p>
                                                                        <p class="mb-4">Contact: <span class="text-primary" id="modalCustomerContact"></span></p>
                                                                        <p class="mb-4"><span class="text-primary" id="modalComplaintDetail"></span></p>
                                                                        <div class="table-responsive">
                                                                            <table class="table align-middle table-nowrap">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">Reference No</th>
                                                                                        <th scope="col">Attachment</th>
                                                                                        <th scope="col">Status</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td id="modalPolicyNumber"></td>
                                                                                        <td><a href="" id="modalAttachment" target="_blank">View</a></td>
                                                                                        <td id="modalStatus"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
            <!-- JavaScript to handle modal data population -->
            <script>
                const transactionModal = document.getElementById('transaction-detailModal');
                transactionModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget; // Button that triggered the modal
                    const complaint = JSON.parse(button.getAttribute('data-complaint')); // Extract info from data-complaint attribute

                    // Update the modal's content
                    document.getElementById('modalComplaintDate').textContent = complaint.complaint_date;
                    document.getElementById('modalCustomerName').textContent = complaint.name;
                    document.getElementById('modalCustomerContact').textContent = complaint.contact_no;
                    document.getElementById('modalComplaintDetail').textContent = complaint.complaint_detail;
                    document.getElementById('modalPolicyNumber').textContent = complaint.policy_number;
                    document.getElementById('modalAttachment').setAttribute('href', '/storage/' + complaint.attachment);
                });
            </script>

            <script src="assets/libs/jquery/jquery.min.js"></script>
            <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="assets/libs/metismenu/metisMenu.min.js"></script>
            <script src="assets/libs/simplebar/simplebar.min.js"></script>
            <script src="assets/libs/node-waves/waves.min.js"></script>

            <script src="assets/libs/parsleyjs/parsley.min.js"></script>

            <script src="assets/js/pages/form-validation.init.js"></script>

            <script src="assets/js/app.js"></script>
        </body>
    </div>
</x-app-layout>