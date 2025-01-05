<!DOCTYPE html>
<html lang="en">

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

<body>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-400 leading-tight">
            View complaints responsive
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Contact No</th>
                                <th>Email</th>
                                <th>Customer Type</th>
                                <th>Policy Number</th>
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
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="transaction-detailModal" tabindex="-1" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transaction-detailModalLabel">Complaint Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Complaint details will be loaded here dynamically using JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var complaintRows = document.querySelectorAll('.complaint-row');
            var transactionDetailModal = document.getElementById('transaction-detailModal');

            complaintRows.forEach(function(row) {
                row.addEventListener('click', function() {
                    var complaint = row.getAttribute('data-complaint');
                    var modalBody = transactionDetailModal.querySelector('.modal-body');
                    modalBody.innerHTML = '<pre>' + JSON.stringify(JSON.parse(complaint), null, 2) + '</pre>';
                    var modal = new bootstrap.Modal(transactionDetailModal);
                    modal.show();
                });
            });
        });
    </script>
</body>

</html>