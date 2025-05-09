@extends('layouts.app')
@section('content')

<div class="bg-white rounded-lg shadow-md border border-gray-100">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h4 class="text-xl font-bold text-gray-700 m-0">Report Generator</h4>
            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">Admin Console</span>
        </div>

        <form id="reportGenerationForm" method="post" action="{{ route('reports.create') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Report Type -->
                <div class="relative">
                    <label for="reportType" class="block text-sm font-medium text-gray-700 mb-1">
                        Report Type <span class="text-red-500">*</span>
                    </label>
                    <select id="reportType" name="report_type" required
                        class="mt-1 block w-full pl-3 pr-10 py-2.5 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="" selected disabled>Please select...</option>
                        <option value="1">Full Report</option>
                        <option value="2">Received/Pending complaints Report</option>
                        <option value="3">Inprogress complaints Report</option>
                        <option value="4">Declined complaints Report</option>
                        <option value="5">Closed complaints Report</option>

                    </select>
                    <div class="error-message text-red-500 text-sm mt-1 hidden">Please select a report type</div>
                </div>

                <!-- Date Range Selection Section -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                    <div class="bg-gray-50 rounded-md p-3">
                        <div class="flex flex-wrap gap-2">
                            <label class="date-option relative inline-flex items-center">
                                <input type="radio" name="date_range_preset" value="7" checked
                                    class="date-preset sr-only peer">
                                <span class="px-4 py-2 rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-700 cursor-pointer peer-checked:bg-indigo-50 peer-checked:border-indigo-500 peer-checked:text-indigo-700 hover:bg-gray-50 transition-colors">
                                    Last 7 days
                                </span>
                            </label>

                            <label class="date-option relative inline-flex items-center">
                                <input type="radio" name="date_range_preset" value="30"
                                    class="date-preset sr-only peer">
                                <span class="px-4 py-2 rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-700 cursor-pointer peer-checked:bg-indigo-50 peer-checked:border-indigo-500 peer-checked:text-indigo-700 hover:bg-gray-50 transition-colors">
                                    Last 30 days
                                </span>
                            </label>

                            <label class="date-option relative inline-flex items-center">
                                <input type="radio" name="date_range_preset" value="custom"
                                    class="date-preset sr-only peer">
                                <span class="px-4 py-2 rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-700 cursor-pointer peer-checked:bg-indigo-50 peer-checked:border-indigo-500 peer-checked:text-indigo-700 hover:bg-gray-50 transition-colors">
                                    Custom
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Custom Date Range  -->
                <div id="customDateRange" class="md:col-span-2 hidden">
                    <div class="bg-gray-50 rounded-md p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="startDate" class="block text-sm font-medium text-gray-700 mb-1">
                                    Start Date
                                </label>
                                <input type="date" id="startDate" name="start_date"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="endDate" class="block text-sm font-medium text-gray-700 mb-1">
                                    End Date
                                </label>
                                <input type="date" id="endDate" name="end_date"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Branch Selection -->
                <div>
                    <label for="branchSelection" class="block text-sm font-medium text-gray-700 mb-1">
                        Brand/Branch
                    </label>
                    <select id="branchSelection" name="branch_selection"
                        class="mt-1 block w-full pl-3 pr-10 py-2.5 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="all" selected>All Branches</option>
                        <option value="multiple">Select Specific Branches</option>
                    </select>
                </div>

                <!-- 4. Complaint Type -->
                <div>
                    <label for="complaintType" class="block text-sm font-medium text-gray-700 mb-1">
                        Complaint Type
                    </label>
                    <select id="complaintType" name="complaint_type"
                        class="mt-1 block w-full pl-3 pr-10 py-2.5 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="all" selected>All Types</option>
                        @foreach($complaintTypes as $type)
                        <option value="{{ $type->complaint_type }}">{{ $type->complaint_type }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- 5. Customer Type -->
                <div>
                    <label for="customerType" class="block text-sm font-medium text-gray-700 mb-1">
                        Customer Type
                    </label>
                    <select id="customerType" name="customer_type"
                        class="mt-1 block w-full pl-3 pr-10 py-2.5 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="all" selected>All Types</option>
                        <option value="Branch">Branch</option>
                        <option value="Customer Hotline">Customer Hotline</option>
                        <option value="Direct Call">Direct Call</option>
                        <option value="Email/Letters">Email/Letters</option>
                        <option value="Walking Customer">Walking Customer</option>
                        <option value="Website">Website</option>
                    </select>
                </div>

                <!-- Multiple Branches Selection (Hidden by default) -->
                <div id="multipleBranches" class="md:col-span-2 hidden">
                    <div class="bg-gray-50 rounded-md p-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Select Branches
                        </label>
                        <select id="branches" name="branches[]" multiple size="5"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                            @endforeach

                        </select>
                        <p class="mt-1 text-sm text-gray-500 italic">Hold Ctrl/Cmd to select multiple branches</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-wrap gap-3">
                <button type="submit" class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Generate Report
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
    document.addEventListener('DOMContentLoaded', function() {
        // Handle custom date range visibility
        const datePresets = document.querySelectorAll('.date-preset');
        const customDateRange = document.getElementById('customDateRange');

        datePresets.forEach(preset => {
            preset.addEventListener('change', function() {
                if (this.value === 'custom') {
                    customDateRange.classList.remove('hidden');
                } else {
                    customDateRange.classList.add('hidden');
                }
            });
        });

        // Handle branch selection
        const branchSelection = document.getElementById('branchSelection');
        const multipleBranches = document.getElementById('multipleBranches');

        branchSelection.addEventListener('change', function() {
            if (this.value === 'multiple') {
                multipleBranches.classList.remove('hidden');
            } else {
                multipleBranches.classList.add('hidden');
            }
        });

        // Form validation
        const reportForm = document.getElementById('reportGenerationForm');
        const reportTypeField = document.getElementById('reportType');
        const reportTypeError = reportTypeField.nextElementSibling;

        reportForm.addEventListener('submit', function(event) {
            let isValid = true;

            // Validate report type
            if (!reportTypeField.value) {
                event.preventDefault();
                reportTypeError.classList.remove('hidden');
                isValid = false;
            } else {
                reportTypeError.classList.add('hidden');
            }

            // Validate custom date range if selected
            if (document.querySelector('input[name="date_range_preset"][value="custom"]').checked) {
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;

                if (!startDate || !endDate) {
                    event.preventDefault();
                    showToast('Please select both start and end dates for custom range', 'warning');
                    isValid = false;
                } else if (new Date(startDate) > new Date(endDate)) {
                    event.preventDefault();
                    showToast('Start date cannot be after end date', 'warning');
                    isValid = false;
                }
            }

            // Validate multiple branches if selected
            if (branchSelection.value === 'multiple') {
                const selectedBranches = Array.from(document.getElementById('branches').selectedOptions);
                if (selectedBranches.length === 0) {
                    event.preventDefault();
                    showToast('Please select at least one branch', 'warning');
                    isValid = false;
                }
            }

            return isValid;
        });

        // Validation on change
        reportTypeField.addEventListener('change', function() {
            if (this.value) {
                reportTypeError.classList.add('hidden');
            }
        });

        // Toast notification function
        function showToast(message, type = 'info') {
            const container = document.getElementById('toast-container');

            // Create toast element
            const toast = document.createElement('div');
            toast.className = `mb-3 p-4 rounded-md shadow-lg max-w-xs flex items-center ${getToastColor(type)}`;
            toast.style.transition = 'all 0.3s ease';

            // Toast icon
            const icon = document.createElement('div');
            icon.className = 'flex-shrink-0 mr-3';
            icon.innerHTML = getToastIcon(type);

            // Toast message
            const text = document.createElement('div');
            text.className = 'text-sm font-medium';
            text.textContent = message;

            // Close button
            const closeBtn = document.createElement('button');
            closeBtn.className = 'ml-auto flex-shrink-0 -mr-1 text-gray-400 hover:text-gray-500 focus:outline-none';
            closeBtn.innerHTML = `
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        `;

            closeBtn.addEventListener('click', () => {
                removeToast(toast);
            });

            // Assemble toast
            toast.appendChild(icon);
            toast.appendChild(text);
            toast.appendChild(closeBtn);

            // Add to container
            container.appendChild(toast);

            // Animate in
            setTimeout(() => {
                toast.style.opacity = '1';
            }, 10);

            // Auto-remove after timeout
            setTimeout(() => {
                removeToast(toast);
            }, 5000);
        }

        function removeToast(toast) {
            toast.style.opacity = '0';
            setTimeout(() => {
                toast.remove();
            }, 300);
        }

        function getToastColor(type) {
            switch (type) {
                case 'success':
                    return 'bg-green-50 text-green-800 border-l-4 border-green-400';
                case 'warning':
                    return 'bg-yellow-50 text-yellow-800 border-l-4 border-yellow-400';
                case 'error':
                    return 'bg-red-50 text-red-800 border-l-4 border-red-400';
                default:
                    return 'bg-blue-50 text-blue-800 border-l-4 border-blue-400';
            }
        }

        function getToastIcon(type) {
            switch (type) {
                case 'success':
                    return `<svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>`;
                case 'warning':
                    return `<svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>`;
                case 'error':
                    return `<svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>`;
                default:
                    return `<svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>`;
            }
        }
    });
</script>

@endsection