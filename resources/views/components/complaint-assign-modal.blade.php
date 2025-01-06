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
                                <td id="modalComplaintStatus"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Assigning</h4>
                        <form class="needs-validation" novalidate action="{{ route('assign.complaint') }}" method="POST">
                            @csrf
                            <input type="hidden" name="modalComplaintId" id="modalComplaintId" value="">
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="validationCustom03" class="form-label">Category</label>
                                            <select class="form-select" id="dept_name" name="dept_id" required>
                                                <option selected disabled>Choose...</option>
                                                @foreach ($departmentNames as $department)
                                                <option value="{{ $department->department_code }}">{{ $department->department_name }}</option>
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
                                            <select class="form-select" id="div_name" name="div_name" required>
                                                <option selected disabled>Choose...</option>
                                                @foreach ($divisionNames as $division)
                                                <option value="{{ $division->division_name }}">{{ $division->division_name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please provide a valid Sub category.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="validationCustom05" class="form-label">District</label>
                                            <select class="form-select" id="district" name="district" required>
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
                                            <select class="form-select" id="branch" name="branch" required>
                                                <option selected disabled value="">Choose...</option>
                                                <option value="Colombo B">Colombo</option>
                                                <option value="Ratnapura B">Ratnapura</option>
                                                <option value="Matara B">Matara</option>
                                                <option value="Kandy B">Kandy</option>
                                                <option value="Trincomalee B">Trincomalee</option>
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
                                        <textarea class="form-control" id="notes" name="notes" placeholder="Add notes for review"></textarea>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-warning" type="submit">Assign</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    const transactionModal = document.getElementById('transaction-detailModal');
    transactionModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const complaint = JSON.parse(button.getAttribute('data-complaint')); // Extract info from data-complaint attribute

        // Update modal content
        document.getElementById('modalComplaintDate').textContent = complaint.complaint_date;
        document.getElementById('modalCustomerName').textContent = complaint.name;
        document.getElementById('modalCustomerContact').textContent = complaint.contact_no;
        document.getElementById('modalComplaintDetail').textContent = complaint.complaint_detail;
        document.getElementById('modalPolicyNumber').textContent = complaint.policy_number;
        document.getElementById('modalAttachment').setAttribute('href', '/storage/' + complaint.attachment);

        // Update status dynamically
        const statusElement = document.getElementById('modalComplaintStatus');
        const status = complaint.complaint_status;
        if (status === 0) {
            statusElement.textContent = 'Received';
        } else if (status === 1) {
            statusElement.textContent = 'Assigned';
        }

        // Set hidden complaint ID
        const complaintIdInput = document.getElementById('modalComplaintId');
        if (complaintIdInput) {
            complaintIdInput.value = complaint.id;
        }
    });
</script>