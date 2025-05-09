<div id="complaintApprove" class="modal fade" tabindex="-1" aria-labelledby="complaintApproveLabel" aria-hidden="true">
    <div class="modal-dialog max-w-md mx-auto">
        <div class="modal-content bg-white rounded shadow-lg">
            <!-- Header -->
            <div class="modal-header flex items-center justify-between bg-gray-50 px-4 py-2 border-b border-gray-200 rounded-t">
                <h5 class="modal-title text-base font-medium text-gray-800" id="complaintApproveLabel">
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
                        <!-- Approval Tab -->
                        <div class="tab-pane active" id="approval" role="tabpanel">
                            <form action="{{route('closeComplaint' , ['id' => $id])}}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                @method('PUT')
                                @csrf
                                <div>
                                    <label for="headNote" class="block text-xs font-medium text-gray-700 mb-1">Final notes</label>
                                    <textarea class="w-full px-2 py-1 text-sm text-gray-700 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" id="headNote" name="headNote" rows="2"></textarea>
                                </div>

                                <div>
                                    <label for="formFileSm" class="block text-xs font-medium text-gray-700 mb-1">Attachment</label>
                                    <input id="formFileSm" name="formFileSm" type="file" class="block w-full text-xs text-gray-500 border border-gray-300 rounded cursor-pointer bg-gray-50 focus:outline-none file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="px-3 py-1 text-xs bg-green-600 text-white rounded hover:bg-green-700 focus:outline-none focus:ring-1 focus:ring-green-500 focus:ring-offset-1 transition-colors">Approve</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>