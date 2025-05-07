<!-- omplaint Modal -->
<div class="modal fade" id="transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content rounded-lg shadow-lg">
            <!-- Modal Header -->
            <div class="modal-header bg-gray-50 border-b border-gray-200 rounded-t-lg px-6 py-4">
                <h5 class="modal-title text-lg font-semibold text-gray-800" id="transaction-detailModalLabel">
                    Complaint Details
                </h5>
                <button type="button" class="text-gray-400 hover:text-gray-600 transition-colors" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-6">
                <!-- Customer Information Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4 mb-6">
                    <h6 class="text-sm font-medium text-gray-500 mb-3">CUSTOMER INFORMATION</h6>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Name</p>
                            <p class="font-medium text-gray-800" id="modalCustomerName"></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Contact</p>
                            <p class="font-medium text-gray-800" id="modalCustomerContact"></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Date Filed</p>
                            <p class="font-medium text-gray-800" id="modalComplaintDate"></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Reference No</p>
                            <p class="font-medium text-gray-800" id="modalPolicyNumber"></p>
                        </div>
                    </div>
                </div>

                <!-- Complaint Details Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4 mb-6">
                    <h6 class="text-sm font-medium text-gray-500 mb-3">COMPLAINT DETAILS</h6>
                    <p class="text-gray-800 whitespace-pre-line" id="modalComplaintDetail"></p>

                    <div class="mt-4 flex items-center">
                        <span class="text-sm text-gray-500 mr-2">Status:</span>
                        <span class="px-2 py-1 text-xs font-medium rounded" id="modalComplaintStatusBadge"></span>
                    </div>

                    <div class="mt-4">
                        <a href="" id="modalAttachment" target="_blank" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                            </svg>
                            View Attachment
                        </a>
                    </div>
                </div>

                <!-- Assign Complaint Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
                    <h6 class="text-sm font-medium text-gray-500 mb-4">ASSIGN COMPLAINT</h6>

                    <form class="needs-validation" novalidate action="{{ route('assign.complaint') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="modalComplaintId" id="modalComplaintId" value="">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- Category Field -->

                            <div>
                                <label for="dept_name" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="department" name="department" required>
                                    <option selected disabled>Choose...</option>
                                    @foreach ($departmentNames as $dept)
                                    <option value="{{ $dept->department_code }}">{{ $dept->department_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback text-red-500 text-xs mt-1">
                                    Please select a valid Category.
                                </div>
                            </div>

                            <!-- Sub Category Field -->
                            <div>
                                <label for="div_name" class="block text-sm font-medium text-gray-700 mb-1">Sub Category</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="div" name="div" required>
                                    <option selected disabled>Choose...</option>
                                </select>
                                <div class="invalid-feedback text-red-500 text-xs mt-1">
                                    Please provide a valid Sub category.
                                </div>
                            </div>

                            <!-- District Field -->
                            <div>
                                <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="priority" name="priority" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                                <div class="invalid-feedback text-red-500 text-xs mt-1">
                                    Please select a valid Priority level.
                                </div>
                            </div>

                            <!-- Branch Field -->

                        </div>

                        <!-- Notes Field -->
                        <div class="mb-4">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="notes" name="notes" rows="3" placeholder="Add notes for review"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                Assign Complaint
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-gray-50 border-t border-gray-200 rounded-b-lg px-6 py-3">
                <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-colors" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        // Update status dynamically with appropriate styling
        const statusElement = document.getElementById('modalComplaintStatusBadge');
        const status = complaint.complaint_status;

        if (status === 0) {
            statusElement.textContent = 'Received';
            statusElement.className = 'px-2 py-1 text-xs font-medium rounded bg-yellow-100 text-yellow-800';
        } else if (status === 1) {
            statusElement.textContent = 'Assigned';
            statusElement.className = 'px-2 py-1 text-xs font-medium rounded bg-green-100 text-green-800';
        }

        // Set hidden complaint ID
        const complaintIdInput = document.getElementById('modalComplaintId');
        if (complaintIdInput) {
            complaintIdInput.value = complaint.id;
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#department').change(function() {
            var departmentCode = $(this).val();
            $.ajax({
                url: '/get-divisions/' + departmentCode,
                type: 'GET',
                success: function(data) {
                    $('#div').empty();
                    $('#div').append('<option selected disabled>Choose...</option>');
                    $.each(data, function(index, division) {
                        $('#div').append('<option value="' + division.division_code + '">' + division.division_name + '</option>');
                    });
                }
            });
        });
    });
</script>