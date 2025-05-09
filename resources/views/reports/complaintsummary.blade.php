@extends('layouts.app')
@section('content')

<div class="bg-white rounded-lg shadow-md border border-gray-100">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h4 class="text-xl font-bold text-gray-700 m-0">Search Complaint</h4>
            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">Admin Console</span>
        </div>

        <form id="reportGenerationForm" method="get" action="{{ route('search.results') }}" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Report Type -->
                <div class="relative">
                    <label for="policySearch" class="block text-sm font-medium text-gray-700 mb-1">
                        Search Policy Number <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="policySearch" name="policySearch" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50" placeholder="Enter the policy number" autocomplete="off" required>
                    <div id="searchResults" class="list-group mt-2" style="display:none;"></div>
                    <div id="searchResults" class="absolute z-10 w-full bg-white shadow-lg rounded-md border border-gray-200 mt-1 max-h-60 overflow-y-auto hidden"></div>
                    <div class="error-message text-red-500 text-sm mt-1 hidden">Please enter a policy number</div>
                </div>

                <!-- Hidden field to store selected policy ID -->
                <input type="hidden" id="selectedPolicyId" name="selectedPolicyId">
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-wrap gap-3">
                <button type="submit" class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Search Complaint
                </button>
                <button type="reset" class="inline-flex items-center px-4 py-2.5 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Reset
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Toast Container -->
<div id="toast-container" class="fixed bottom-4 right-4 z-50"></div>
<script>
    $(document).ready(function() {
        $('#policySearch').on('input', function() {
            const searchTerm = $(this).val();

            if (searchTerm.length >= 2) { // Only search after 2 characters
                $.get('/search-policies', {
                    term: searchTerm
                }, function(data) {
                    const resultsContainer = $('#searchResults');

                    if (data.length > 0) {
                        resultsContainer.empty();

                        data.forEach(function(item) {
                            resultsContainer.append(
                                `<a href="#" class="list-group-item list-group-item-action">
                                <strong>${item.policy_number}</strong> - ${item.name}
                            </a>`
                            );
                        });

                        resultsContainer.show();
                    } else {
                        resultsContainer.hide();
                    }
                });
            } else {
                $('#searchResults').hide();
            }
        });

        // Hide results when clicking elsewhere
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#policySearch, #searchResults').length) {
                $('#searchResults').hide();
            }
        });

        // Fill input when a result is clicked
        $('#searchResults').on('click', 'a', function(e) {
            e.preventDefault();
            const policyNumber = $(this).find('strong').text();
            $('#policySearch').val(policyNumber);
            $('#searchResults').hide();
            // You can trigger additional actions here if needed
        });
    });
</script>


@endsection