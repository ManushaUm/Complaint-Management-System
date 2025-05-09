<div id="complaintReject" class="modal fade" tabindex="-1" aria-labelledby="complaintRejectLabel" aria-hidden="true">
    <div class="modal-dialog max-w-md mx-auto">
        <div class="modal-content bg-white rounded shadow-lg">
            <!-- Header -->
            <div class="modal-header flex items-center justify-between bg-gray-50 px-4 py-2 border-b border-gray-200 rounded-t">
                <h5 class="modal-title text-base font-medium text-gray-800" id="complaintRejectLabel">
                    Complaint actions on <a href="#" class="text-blue-600 hover:text-blue-800">{{$prevData[0]->policy_number}}</a>
                </h5>
                <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none" data-bs-dismiss="modal" aria-label="Close">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-4">
                <!-- Main Tabs -->
                <div class="border border-gray-200 rounded">
                    <div class="tab-content py-3 px-3">

                        <div class="tab-pane active" id="reject" role="tabpanel">
                            <div class="flex flex-col sm:flex-row gap-3">


                                <!-- Tab Content -->
                                <div class="w-full">
                                    <div class="tab-content">
                                        <!-- Reject Form -->
                                        <div class="tab-pane active" id="reject-tab" role="tabpanel">
                                            <form action="{{route('rejectComplaint' , ['id' => $id])}}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                                @csrf
                                                @method('PUT')
                                                <div>
                                                    <label for="headNote" class="block text-xs font-medium text-gray-700 mb-1">Final notes</label>
                                                    <textarea class="w-full px-2 py-1 text-sm text-gray-700 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" id="headNote" name="headNote" rows="2"></textarea>
                                                </div>

                                                <div>
                                                    <label for="formFileSm" class="block text-xs font-medium text-gray-700 mb-1">Attachment</label>
                                                    <input id="formFileSm" name="formFileSm" type="file" class="block w-full text-xs text-gray-500 border border-gray-300 rounded cursor-pointer bg-gray-50 focus:outline-none file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                                </div>

                                                <div class="flex items-center">
                                                    <input class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500" type="checkbox" id="userUpdate">
                                                    <label class="ml-2 text-xs text-gray-700" for="userUpdate">
                                                        Notify {{$prevData[0]->logged_by}} rejection notice
                                                    </label>
                                                </div>

                                                <div class="flex justify-end">
                                                    <button type="submit" class="px-3 py-1 text-xs bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-1 focus:ring-red-500 focus:ring-offset-1 transition-colors">Reject</button>
                                                </div>
                                            </form>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap tab functionality script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all tab toggle links
        const tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');

        // Add click event listener to each tab link
        tabLinks.forEach(function(tabLink) {
            tabLink.addEventListener('click', function(event) {
                event.preventDefault();

                // Remove active class from all tab links
                tabLinks.forEach(function(link) {
                    link.classList.remove('active', 'text-blue-600', 'bg-blue-50', 'border-l-2', 'border-blue-600');
                    link.classList.add('text-gray-700');
                });

                // Add active class to clicked tab link
                this.classList.add('active', 'text-blue-600', 'bg-blue-50', 'border-l-2', 'border-blue-600');
                this.classList.remove('text-gray-700');

                // Get the target tab pane
                const targetId = this.getAttribute('href');
                const targetPane = document.querySelector(targetId);

                // Hide all tab panes
                const tabPanes = document.querySelectorAll('.tab-pane');
                tabPanes.forEach(function(pane) {
                    pane.classList.remove('active', 'show');
                    pane.classList.add('fade');
                });

                // Show the target tab pane
                targetPane.classList.add('active', 'show');
                targetPane.classList.remove('fade');
            });
        });
    });
</script>