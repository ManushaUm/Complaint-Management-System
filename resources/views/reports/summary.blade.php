@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="text-lg font-semibold text-gray-800">Complaints Summary</h2>
        </div>
    </div>

    <!-- Simple Date Selection Form -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="dateFilterForm" class="flex flex-wrap gap-4 items-end">
                        <div class="flex-1">
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">
                                Start Date
                            </label>
                            <input type="date" id="start_date" name="start_date"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                value="{{ now()->subDays(30)->format('Y-m-d') }}">
                        </div>
                        <div class="flex-1">
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">
                                End Date
                            </label>
                            <input type="date" id="end_date" name="end_date"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                value="{{ now()->format('Y-m-d') }}">
                        </div>
                        <div>
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16 text-center">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Complaint Category</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Received</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">In Progress</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Declined</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Recommend to Close</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Refer to CEO</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Closed</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="summaryTableBody">
                        <!-- Data will be loaded here via JavaScript -->
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                Loading complaint data...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    console.log("Script is running"); // This should appear immediately

    $(document).ready(function() {
        //console.log("jQuery version:", $.fn.jquery); // Check jQuery is loaded
        // Load data when page loads
        fetchSummaryData();

        // Handle form submission
        $('#dateFilterForm').on('submit', function(e) {
            e.preventDefault();
            fetchSummaryData();
        });

        function fetchSummaryData() {
            const startDate = $('#start_date').val();
            const endDate = $('#end_date').val();

            console.log("Fetching data for:", startDate, "to", endDate);

            // Show loading state
            $('#summaryTableBody').html(`
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                        Loading complaint data...
                    </td>
                </tr>
            `);

            $.ajax({
                url: "{{ route('reports.summary') }}",
                type: "GET",
                data: {
                    duration: 'custom',
                    start_date: startDate,
                    end_date: endDate
                },
                success: function(response) {
                    console.log("AJAX Response:", response);
                    updateSummaryTable(response.summary);
                },
                error: function(xhr) {
                    $('#summaryTableBody').html(`
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-red-500">
                                Error loading complaint data
                            </td>
                        </tr>
                    `);
                    console.error(xhr.responseText);
                }
            });
        }

        function updateSummaryTable(summaryData) {
            const $tbody = $('#summaryTableBody');
            $tbody.empty();

            if (!summaryData || Object.keys(summaryData).length === 0) {
                $tbody.html(`
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                            No complaints found for the selected period
                        </td>
                    </tr>
                `);
                return;
            }

            // Define categories in order with their display names
            const categories = [{
                    key: 'marketing_and_sales',
                    name: 'Marketing and Sales'
                },
                {
                    key: 'motor_underwriting',
                    name: 'Motor Underwriting'
                },
                {
                    key: 'non_motor_underwriting',
                    name: 'Non-motor Underwriting'
                },
                {
                    key: 'motor_claims',
                    name: 'Motor Claims'
                },
                {
                    key: 'non_motor_claims',
                    name: 'Non-motor Claims'
                },
                {
                    key: 'policy_serving',
                    name: 'Policy Serving'
                },
                {
                    key: 'premium',
                    name: 'Premium'
                },
                {
                    key: 'others',
                    name: 'Others'
                }
            ];

            let totals = {
                received: 0,
                in_progress: 0,
                declined: 0,
                recommend_to_close: 0,
                refer_to_ceo: 0,
                closed: 0
            };

            // Add each category row
            categories.forEach((category, index) => {
                const categoryData = summaryData[category.key] || {};

                // Get counts for each status (handle both "status" and "status with space" formats)
                const received = categoryData.received?.count || 0;
                const inProgress = (categoryData.in_progress?.count || categoryData['in progress']?.count || 0);
                const declined = categoryData.declined?.count || 0;
                const recommendClose = (categoryData.recommend_to_close?.count || categoryData['recommend to close']?.count || 0);
                const referCEO = (categoryData.refer_to_ceo?.count || categoryData['refer to ceo']?.count || 0);
                const closed = categoryData.closed?.count || 0;

                // Update totals
                totals.received += received;
                totals.in_progress += inProgress;
                totals.declined += declined;
                totals.recommend_to_close += recommendClose;
                totals.refer_to_ceo += referCEO;
                totals.closed += closed;

                // Add row to table
                $tbody.append(`
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">${index + 1}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-sm font-medium bg-amber-100 text-amber-800">
                                ${category.name}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-100 text-red-800">
                                ${received || '-'}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-800">
                                ${inProgress || '-'}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-purple-100 text-purple-800">
                                ${declined || '-'}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-amber-100 text-amber-800">
                                ${recommendClose || '-'}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-green-100 text-green-800">
                                ${referCEO || '-'}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-green-100 text-green-800">
                                ${closed || '-'}
                            </span>
                        </td>
                    </tr>
                `);
            });

            // Add totals row
            $tbody.append(`
                <tr class="bg-gray-50 font-medium">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">-</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">TOTAL</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold text-center">${totals.received}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold text-center">${totals.in_progress}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold text-center">${totals.declined}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold text-center">${totals.recommend_to_close}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold text-center">${totals.refer_to_ceo}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold text-center">${totals.closed}</td>
                </tr>
            `);
        }
    });
</script>


@endsection