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
            <div id="layout-wrapper">
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
                                                                        <th>Insured?</th>
                                                                        <th>If not insured, relation</th>
                                                                        <th>Address</th>
                                                                        <th>Contact No</th>
                                                                        <th>Email</th>
                                                                        <th>Customer Type</th>
                                                                        <th>Policy/Vehicle Number</th>
                                                                        <th>Complaint Date</th>
                                                                        <th>Complaint Details</th>
                                                                        <th>Attachment</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($complaints as $complaint)
                                                                    <tr>
                                                                        <td>{{ $complaint->name }}</td>
                                                                        <td>{{ $complaint->insured }}</td>
                                                                        <td>{{ $complaint->relation }}</td>
                                                                        <td>{{ $complaint->address }}</td>
                                                                        <td>{{ $complaint->contact_no }}</td>
                                                                        <td>{{ $complaint->email }}</td>
                                                                        <td>{{ $complaint->complaint_type }}</td>
                                                                        <td>{{ $complaint->policy_number }}</td>
                                                                        <td>{{ $complaint->complaint_date }}</td>
                                                                        <td>{{ $complaint->complaint_detail }}</td>
                                                                        <td><a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank">View Attachment</a></td>
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
                                                                        <p class="mb-2">Complaint date: <span class="text-primary" id="modalComplaintDate"></span></p>
                                                                        <p class="mb-4">Customer Name: <span class="text-primary" id="modalCustomerName"></span></p>

                                                                        <div class="table-responsive">
                                                                            <table class="table align-middle table-nowrap">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">Customer</th>
                                                                                        <th scope="col">Policy/Vehicle Number</th>
                                                                                        <th scope="col">Attachment</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th scope="row">
                                                                                            <div>
                                                                                                <img src="assets/images/default-avatar.png" alt="" class="avatar-sm">
                                                                                            </div>
                                                                                        </th>
                                                                                        <td id="modalPolicyNumber"></td>
                                                                                        <td><a href="" id="modalAttachment" target="_blank">View Attachment</a></td>
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
            </div>

            <!-- JavaScript to handle modal data population -->
            <script>
                const transactionModal = document.getElementById('transaction-detailModal');
                transactionModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget; // Button that triggered the modal
                    const complaint = JSON.parse(button.getAttribute('data-complaint')); // Extract info from data-complaint attribute

                    // Update the modal's content
                    document.getElementById('modalComplaintDate').textContent = complaint.complaint_date;
                    document.getElementById('modalCustomerName').textContent = complaint.name;
                    document.getElementById('modalPolicyNumber').textContent = complaint.policy_number;
                    document.getElementById('modalAttachment').setAttribute('href', '/storage/' + complaint.attachment);
                });
            </script>
        </body>
    </div>
</x-app-layout>