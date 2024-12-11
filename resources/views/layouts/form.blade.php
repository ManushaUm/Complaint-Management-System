<head>
    <!-- Metadata and CSS/JS links remain the same -->
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
                                    <h4 class="card-title mb-4">New Complaints</h4>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Customer</th>
                                                    <th>Insured?</th>
                                                    <th>Relation</th>
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
                                                        <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                                                            data-bs-toggle="modal" data-bs-target="#transaction-detailModal"
                                                            data-complaint='@json($complaint)'>
                                                            View Details
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <!-- Complaint Detail Modal with Form Format -->
                                    <div class="modal fade" id="transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="transaction-detailModalLabel">Complaint Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="mb-3">
                                                            <label class="form-label">Complaint Date</label>
                                                            <input type="text" class="form-control" id="modalComplaintDate" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Customer Name</label>
                                                            <input type="text" class="form-control" id="modalCustomerName" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Insured</label>
                                                            <input type="text" class="form-control" id="modalInsured" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Relation (If not insured)</label>
                                                            <input type="text" class="form-control" id="modalRelation" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Address</label>
                                                            <input type="text" class="form-control" id="modalAddress" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Contact No</label>
                                                            <input type="text" class="form-control" id="modalContactNo" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="modalEmail" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Policy/Vehicle Number</label>
                                                            <input type="text" class="form-control" id="modalPolicyNumber" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Complaint Details</label>
                                                            <textarea class="form-control" id="modalComplaintDetail" rows="3" readonly></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Attachment</label>
                                                            <a href="" id="modalAttachment" target="_blank">View Attachment</a>
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
        </div>

        <!-- JavaScript to handle modal data population -->
        <script>
            const transactionModal = document.getElementById('transaction-detailModal');
            transactionModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const complaint = JSON.parse(button.getAttribute('data-complaint'));

                // Populate modal fields with complaint data
                document.getElementById('modalComplaintDate').value = complaint.complaint_date;
                document.getElementById('modalCustomerName').value = complaint.name;
                document.getElementById('modalInsured').value = complaint.insured;
                document.getElementById('modalRelation').value = complaint.relation;
                document.getElementById('modalAddress').value = complaint.address;
                document.getElementById('modalContactNo').value = complaint.contact_no;
                document.getElementById('modalEmail').value = complaint.email;
                document.getElementById('modalPolicyNumber').value = complaint.policy_number;
                document.getElementById('modalComplaintDetail').value = complaint.complaint_detail;
                document.getElementById('modalAttachment').setAttribute('href', '/storage/' + complaint.attachment);
            });
        </script>
    </body>
</div>
</x-app-layout>
