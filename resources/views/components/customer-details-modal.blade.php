<!-- Customer Details Modal -->
<div id="customerDetails" class="modal fade" tabindex="-1" aria-labelledby="customerDetailsLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-lg shadow-lg border-0">
            <!-- Modal Header -->
            <div class="modal-header border-b border-gray-100 px-6 py-4">
                <h3 class="modal-title text-lg font-medium text-gray-800" id="customerDetailsLabel">Customer Details</h3>
                <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none" data-bs-dismiss="modal" aria-label="Close">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-6">
                <div class="bg-white rounded-lg">
                    <!-- Customer Info Header -->
                    <div class="text-center mb-6">
                        <div class="flex justify-center mb-4">
                            <div class="h-20 w-20 rounded-full bg-blue-50 flex items-center justify-center">
                                <svg class="h-10 w-10 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                        <h4 class="text-lg font-medium text-gray-800 mb-1">{{$initcomplaint->name}}</h4>
                        <p class="text-sm text-gray-500">Customer ID: #{{$initcomplaint->id}}</p>
                    </div>

                    <!-- Contact Details -->
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center">
                                <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h5 class="text-sm font-medium text-gray-800 mb-1">Phone</h5>
                                <p class="text-sm text-gray-600">{{$initcomplaint->contact_no}}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center">
                                <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h5 class="text-sm font-medium text-gray-800 mb-1">Email</h5>
                                <p class="text-sm text-gray-600">{{$initcomplaint->email}}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center">
                                <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h5 class="text-sm font-medium text-gray-800 mb-1">Address</h5>
                                <p class="text-sm text-gray-600">{{$initcomplaint->address}}</p>
                            </div>
                        </div>

                        <!-- Additional Customer Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 pt-6 border-t border-gray-100">
                            <div>
                                <h5 class="text-sm font-medium text-gray-800 mb-1">Customer Type</h5>
                                <p class="text-sm text-gray-600">{{$initcomplaint->customer_type}}</p>
                            </div>
                            <div>
                                <h5 class="text-sm font-medium text-gray-800 mb-1">Policy Number</h5>
                                <p class="text-sm text-gray-600">{{$initcomplaint->policy_number}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer border-t border-gray-100 px-6 py-4">
                <div class="flex justify-between items-center w-full">
                    <button type="button" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" data-bs-dismiss="modal">
                        Close
                    </button>
                    <a href="#!" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        View Full Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>