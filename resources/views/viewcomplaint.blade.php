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
                                                                    <tr class="complaint-row" data-complaint='@json($complaint)' data-complaint-id="{{ $complaint->id }}">
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
                                                                                data-complaint='@json($complaint)'
                                                                                data-complaint-id="{{ $complaint->id }}">
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


                                                        <x-complaint-assign-modal :departmentNames="$departmentNames" :divisionNames="$divisionNames" />

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
            <!-- Modal -->
            <div class="modal fade" id="transaction-detailModalsimple" tabindex="-1" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="transaction-detailModalLabel">Complaint Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Name:</h6>
                                        <p id="complaint-name"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Contact No:</h6>
                                        <p id="complaint-contact_no"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Email:</h6>
                                        <p id="complaint-email"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Customer Type:</h6>
                                        <p id="complaint-customer_type"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Policy Number:</h6>
                                        <p id="complaint-policy_number"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Complaint Date:</h6>
                                        <p id="complaint-complaint_date"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h6>Complaint Detail:</h6>
                                        <p id="complaint-complaint_detail"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a id="download-pdf-button" href="#" class="btn btn-primary">Download PDF</a>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var complaintRows = document.querySelectorAll('.complaint-row');
                                var transactionDetailModal = document.getElementById('transaction-detailModalsimple');

                                complaintRows.forEach(function(row) {
                                    row.addEventListener('click', function(event) {
                                        // Check if the click event originated from the "View Details" button
                                        if (event.target.tagName === 'BUTTON') {
                                            return;
                                        }

                                        var complaint = JSON.parse(row.getAttribute('data-complaint'));
                                        document.getElementById('complaint-name').innerText = complaint.name;
                                        document.getElementById('complaint-contact_no').innerText = complaint.contact_no;
                                        document.getElementById('complaint-email').innerText = complaint.email;
                                        document.getElementById('complaint-customer_type').innerText = complaint.customer_type;
                                        document.getElementById('complaint-policy_number').innerText = complaint.policy_number;
                                        document.getElementById('complaint-complaint_date').innerText = complaint.complaint_date;
                                        document.getElementById('complaint-complaint_detail').innerText = complaint.complaint_detail;

                                        var modalTitle = document.getElementById('transaction-detailModalLabel');
                                        modalTitle.innerText = 'Complaint Details (ID: ' + complaint.id + ')';

                                        // Set the download PDF button link
                                        var downloadPdfButton = document.getElementById('download-pdf-button');
                                        downloadPdfButton.href = '/complaint/' + complaint.id + '/download-pdf';

                                        var modal = new bootstrap.Modal(transactionDetailModal);
                                        modal.show();
                                    });
                                });
                            });
                        </script>

                        @endauth

        </body>
    </div>
</x-app-layout>