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

                                                    @foreach($divisionNames as $division)

                                                    <option value="{{$division->division_name}}">{{$division->division_name}}</option>
                                                    @endforeach
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