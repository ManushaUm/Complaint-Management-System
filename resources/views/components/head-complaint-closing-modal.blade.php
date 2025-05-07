@auth
<div id="complaintAction" class="modal fade" tabindex="-1" aria-labelledby="complaintActionLabel" aria-hidden="true">
    @if(Auth::user()->role == 'head')
    <div class="modal-dialog max-w-md mx-auto">
        <div class="modal-content bg-white rounded shadow-lg">
            <!-- Header -->
            <div class="modal-header flex items-center justify-between bg-gray-50 px-4 py-2 border-b border-gray-200 rounded-t">
                <h5 class="modal-title text-base font-medium text-gray-800" id="complaintActionLabel">Complaint Closing</h5>
                <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none" data-bs-dismiss="modal" aria-label="Close">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{route('closeComplaint' , ['id' => $id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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

                    <!-- Form Inputs -->
                    <div class="mb-3 space-y-3">
                        <div>
                            <label for="headNote" class="block text-xs font-medium text-gray-700 mb-1">Notes</label>
                            <textarea class="w-full px-2 py-1 text-sm text-gray-700 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" id="headNote" name="headNote" rows="2"></textarea>
                        </div>

                        <div>
                            <label for="formFileSm" class="block text-xs font-medium text-gray-700 mb-1">Attachment</label>
                            <input id="formFileSm" name="formFileSm" type="file" class="block w-full text-xs text-gray-500 border border-gray-300 rounded cursor-pointer bg-gray-50 focus:outline-none file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer flex justify-end space-x-2 bg-gray-50 px-4 py-2 border-t border-gray-200 rounded-b">
                    <button type="button" class="px-3 py-1 text-xs bg-gray-200 text-gray-700 rounded hover:bg-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 transition-colors" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="px-3 py-1 text-xs bg-green-600 text-white rounded hover:bg-green-700 focus:outline-none focus:ring-1 focus:ring-green-500 focus:ring-offset-1 transition-colors">Close Job</button>
                </div>
            </form>
        </div>
    </div>

    @elseif(Auth::user()->role == 'd-head')
    <div class="modal-dialog max-w-md mx-auto">
        <div class="modal-content bg-white rounded shadow-lg">
            <!-- Header -->
            <div class="modal-header flex items-center justify-between bg-gray-50 px-4 py-2 border-b border-gray-200 rounded-t">
                <h5 class="modal-title text-base font-medium text-gray-800" id="complaintActionLabel">
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
                    <div class="border-b border-gray-200">
                        <ul class="flex text-xs font-medium">
                            <li class="w-1/2">
                                <a class="inline-block p-2 w-full text-center border-b-2 border-blue-600 text-blue-600 bg-white" data-bs-toggle="tab" href="#approval" role="tab">
                                    Approval
                                </a>
                            </li>
                            <li class="w-1/2">
                                <a class="inline-block p-2 w-full text-center text-gray-500 hover:text-gray-700 hover:border-gray-300" data-bs-toggle="tab" href="#reject" role="tab">
                                    Reject
                                </a>
                            </li>
                        </ul>
                    </div>

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

                        <!-- Reject Tab -->
                        <div class="tab-pane" id="reject" role="tabpanel">
                            <div class="flex flex-col sm:flex-row gap-3">
                                <!-- Vertical Tabs -->
                                <div class="sm:w-1/4 flex sm:flex-col bg-gray-50 rounded-md">
                                    <a class="px-3 py-2 text-xs font-medium text-blue-600 bg-blue-50 border-l-2 border-blue-600 hover:bg-blue-100 w-full" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab">Reject</a>
                                    <a class="px-3 py-2 text-xs font-medium text-gray-700 hover:bg-gray-100 w-full" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab">Reopen</a>
                                </div>

                                <!-- Tab Content -->
                                <div class="sm:w-3/4">
                                    <div class="tab-content">
                                        <!-- Reject Form -->
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
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

                                        <!-- Reopen Form -->
                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                            <form action="{{route('logcomplaint' , ['id' => $id, 'newData' => $newData])}}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                                @method('PUT')
                                                @csrf
                                                <div>
                                                    <label for="headNote" class="block text-xs font-medium text-gray-700 mb-1">Remarks</label>
                                                    <textarea class="w-full px-2 py-1 text-sm text-gray-700 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500" id="headNote" name="headNote" rows="2"></textarea>
                                                </div>

                                                <div>
                                                    <label for="formFileSm" class="block text-xs font-medium text-gray-700 mb-1">Attachment</label>
                                                    <input id="formFileSm" name="formFileSm" type="file" class="block w-full text-xs text-gray-500 border border-gray-300 rounded cursor-pointer bg-gray-50 focus:outline-none file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                                </div>

                                                <div class="flex items-center">
                                                    <input class="w-3 h-3 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500" name="checkbox" type="checkbox" id="userUpdate" value="{{$newData[sizeof($newData)-1]->Assigned_to}}">
                                                    <label class="ml-2 text-xs text-gray-700" for="userUpdate">
                                                        Assign complaint to {{$newData[sizeof($newData)-1]->Assigned_to}}
                                                    </label>
                                                </div>

                                                <div class="flex justify-end">
                                                    <button type="submit" class="px-3 py-1 text-xs bg-yellow-600 text-white rounded hover:bg-yellow-700 focus:outline-none focus:ring-1 focus:ring-yellow-500 focus:ring-offset-1 transition-colors">Reopen</button>
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
    @endif
</div>
@endauth