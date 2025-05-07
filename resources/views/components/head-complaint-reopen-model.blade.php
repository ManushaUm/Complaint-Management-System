<div id="complaintOpen" class="modal fade" tabindex="-1" aria-labelledby="complaintOpenLabel" aria-hidden="true">
    <div class="modal-dialog max-w-md mx-auto">
        <div class="modal-content bg-white rounded shadow-lg">
            <!-- Header -->
            <div class="modal-header flex items-center justify-between bg-gray-50 px-4 py-2 border-b border-gray-200 rounded-t">
                <h5 class="modal-title text-base font-medium text-gray-800" id="complaintOpenLabel">Complaint Re-open</h5>
                <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none" data-bs-dismiss="modal" aria-label="Close">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body p-4">
                <!-- Complaint Summary Card -->
                <div class="bg-blue-50 rounded border border-blue-100 mb-3 text-xs">
                    <div class="p-3">
                        <h6 class="text-sm font-medium text-blue-800 mb-2">Ref: <span class="font-bold">{{$prevData[0]->id}}</span></h6>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <tbody class="divide-y divide-blue-100">
                                    <tr class="bg-blue-50">
                                        <th class="py-1 px-2 text-left text-gray-700 font-medium">Policy Number</th>
                                        <td class="py-1 px-2 text-gray-800">{{$prevData[0]->policy_number}}</td>
                                    </tr>
                                    <tr class="bg-white">
                                        <th class="py-1 px-2 text-left text-gray-700 font-medium">Received</th>
                                        <td class="py-1 px-2 text-gray-800">{{$prevData[0]->complaint_date}}</td>
                                    </tr>
                                    <tr class="bg-blue-50">
                                        <th class="py-1 px-2 text-left text-gray-700 font-medium">Last Check</th>
                                        <td class="py-1 px-2 text-gray-800">{{$newData[sizeof($newData)-1]->Assigned_to}}</td>
                                    </tr>
                                    <tr class="bg-white">
                                        <th class="py-1 px-2 text-left text-gray-700 font-medium">Submitted on</th>
                                        <td class="py-1 px-2 text-gray-800">{{$newData[sizeof($newData)-1]->updated_at}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Action Tab -->
                <div class="bg-white rounded border border-gray-200">
                    <div>
                        <!-- Tab Header -->
                        <div class="border-b border-gray-200">
                            <div class="flex -mb-px text-xs font-medium text-center">
                                <span class="inline-block p-2 w-full text-blue-600 border-b-2 border-blue-600 rounded-t">
                                    Action Required
                                </span>
                            </div>
                        </div>

                        <!-- Tab Content -->
                        <div class="p-3">
                            <form action="{{route('logcomplaint' , ['id' => $id])}}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                @csrf
                                @method('put')

                                <!-- Notes Field -->
                                <div class="mb-2">
                                    <label for="headNote" class="block text-xs font-medium text-gray-700 mb-1">
                                        Notes <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="headNote" name="headNote" rows="2" class="w-full px-2 py-1 text-sm text-gray-700 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>

                                <!-- Priority Dropdown -->
                                <div class="mb-2">
                                    <label for="priority" class="block text-xs font-medium text-gray-700 mb-1">
                                        Priority <span class="text-red-500">*</span>
                                    </label>
                                    <select id="priority" name="priority" class="w-full px-2 py-1 text-sm text-gray-700 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                        <option selected>Select...</option>
                                        <option value="high">High</option>
                                        <option value="medium">Medium</option>
                                        <option value="low">Low</option>
                                    </select>
                                </div>

                                <!-- File Upload -->
                                <div class="mb-2">
                                    <label for="formFileSm" class="block text-xs font-medium text-gray-700 mb-1">
                                        Attachment
                                    </label>
                                    <input id="formFileSm" name="formFileSm" type="file" class="block w-full text-xs text-gray-500 border border-gray-300 rounded cursor-pointer bg-gray-50 focus:outline-none file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                </div>

                                <!-- User Assignment -->
                                <div class="flex items-center mb-2">
                                    <input id="userAssignment" name="userAssignment" type="checkbox" value="{{$newData[sizeof($newData)-1]->Assigned_to}}" class="w-3 h-3 border border-gray-300 rounded bg-gray-50 focus:ring-1 focus:ring-blue-300">
                                    <label for="userAssignment" class="ml-2 text-xs text-gray-700">
                                        Assign job to <span class="text-blue-600 font-medium">{{$newData[sizeof($newData)-1]->Assigned_to}}</span>
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex justify-end">
                                    <button type="submit" class="px-3 py-1 text-xs bg-green-600 text-white rounded hover:bg-green-700 focus:outline-none focus:ring-1 focus:ring-green-500 focus:ring-offset-1 transition-colors">
                                        Log Complaint
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer flex justify-end space-x-2 bg-gray-50 px-4 py-2 border-t border-gray-200 rounded-b">
                <button type="button" class="px-3 py-1 text-xs bg-gray-200 text-gray-700 rounded hover:bg-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 transition-colors" data-bs-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>