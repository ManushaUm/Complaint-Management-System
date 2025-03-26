<div
    x-data="complaintFilter({{ json_encode($complaints) }})"
    class="bg-white shadow-md rounded-lg overflow-hidden">

    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center justify-between">
        <h2 class="text-xl font-semibold text-gray-800">Customer Complaints</h2>

        <div class="flex space-x-4 items-center">
            <!-- Search Input -->
            <div class="relative">
                <input
                    x-model="searchTerm"
                    placeholder="Search complaints..."
                    class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-200 focus:outline-none">
                <svg x-show="searchTerm"
                    @click="searchTerm = ''"
                    class="absolute right-3 top-3 h-4 w-4 text-gray-500 cursor-pointer hover:text-gray-700"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>

            <!-- Customer Type Filter -->
            <select
                x-model="customerTypeFilter"
                class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-200 focus:outline-none">
                <option value="">All Customer Types</option>
                <option value="1">Type 1</option>
                <option value="2">Type 2</option>
                <option value="3">Type 3</option>
            </select>

            <!-- Date Range Filter -->
            <div class="flex items-center space-x-2">
                <input
                    type="date"
                    x-model="startDate"
                    class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-200 focus:outline-none">
                <span>to</span>
                <input
                    type="date"
                    x-model="endDate"
                    class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-200 focus:outline-none">
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100 border-b border-gray-200">
                <tr>
                    @foreach(['Customer', 'Contact No', 'Customer Type', 'Policy/Vehicle Number', 'Complaint Date', 'Actions'] as $header)
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ $header }}
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <template x-for="complaint in filteredComplaints" :key="complaint.id">
                    <tr class="hover:bg-gray-50 transition-colors duration-200"
                        :class="complaint.priority == 'high' ? 'bg-red-50' : ''">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900" x-text="complaint.name || 'N/A'"></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500" x-text="complaint.contact_no || 'N/A'"></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                x-text="complaint.customer_type || 'N/A'"
                                :class="{
                                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full': true,
                                    'bg-green-100 text-green-800': complaint.customer_type == 1,
                                    'bg-yellow-100 text-yellow-800': complaint.customer_type == 2,
                                    'bg-blue-100 text-blue-800': complaint.customer_type == 3
                                }"></span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="complaint.policy_number || 'N/A'"></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500" x-text="complaint.complaint_date || 'N/A'"></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <button
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#transaction-detailModal"
                                :data-complaint="JSON.stringify(complaint)"
                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium 
                                rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 
                                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 
                                transition-colors duration-200">
                                View Details
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>

        <!-- No Results -->
        <template x-if="filteredComplaints.length === 0">
            <div class="text-center py-6 text-gray-500">
                No complaints found matching your filters.
            </div>
        </template>
    </div>
</div>

<!-- Existing Complaint Assign Modal -->
<x-complaint-assign-modal :departmentNames="$departmentNames" :divisionNames="$divisionNames" />

<script>
    function complaintFilter(complaints) {
        return {
            complaints,
            searchTerm: '',
            customerTypeFilter: '',
            startDate: '',
            endDate: '',

            get filteredComplaints() {
                return this.complaints.filter(complaint => {
                    // Search filter
                    const matchesSearch = !this.searchTerm ||
                        Object.values(complaint).some(value =>
                            String(value).toLowerCase().includes(this.searchTerm.toLowerCase())
                        );

                    // Customer Type filter
                    const matchesCustomerType = !this.customerTypeFilter ||
                        complaint.customer_type == this.customerTypeFilter;

                    // Date range filter
                    const matchesDateRange =
                        (!this.startDate || new Date(complaint.complaint_date) >= new Date(this.startDate)) &&
                        (!this.endDate || new Date(complaint.complaint_date) <= new Date(this.endDate));

                    return matchesSearch && matchesCustomerType && matchesDateRange;
                });
            }
        }
    }
</script>