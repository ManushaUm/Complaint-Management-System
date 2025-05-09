<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">System logged Complaints</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Complaint Type
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Policy/Vehicle Number
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Customer Type
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Complaint Date
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Assigned to
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($complaints as $complaint)
                <tr class="hover:bg-gray-50 transition-colors duration-200 {{ $complaint->priority == 'high' ? 'bg-red-50' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $complaint->complaint_type ?? 'N/A' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $complaint->policy_number ?? 'N/A' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                        $customerTypeClass = 'bg-gray-100 text-gray-800';
                        if($complaint->customer_type == 'Branch') {
                        $customerTypeClass = 'bg-green-100 text-green-800';
                        } elseif($complaint->customer_type == 'Customer Hotline') {
                        $customerTypeClass = 'bg-yellow-100 text-yellow-800';
                        } elseif($complaint->customer_type == 'Website') {
                        $customerTypeClass = 'bg-blue-100 text-blue-800';
                        } elseif($complaint->customer_type == 'Direct Call') {
                        $customerTypeClass = 'bg-purple-100 text-purple-800';
                        } elseif($complaint->customer_type == 'Email/Letters') {
                        $customerTypeClass = 'bg-pink-100 text-pink-800';
                        } elseif($complaint->customer_type == 'Walking Customer') {
                        $customerTypeClass = 'bg-indigo-100 text-indigo-800';
                        }
                        @endphp
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $customerTypeClass }}">
                            {{ $complaint->customer_type ?? 'N/A' }}
                        </span>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $complaint->complaint_date ?? 'N/A' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">
                            @php
                            $assignedTo = 'N/A';

                            foreach($latestLogs as $log) {
                            if($log->Reference_number == $complaint->reference) {
                            $assignedToId = $log->Assigned_to;

                            // Find employee name
                            foreach($hrData as $hr) {
                            if($hr->emp_id == $assignedToId) {
                            $assignedTo = $hr->full_name;
                            break;
                            }
                            }

                            break;
                            }
                            }
                            @endphp
                            {{ $assignedTo }}

                        </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <a
                            href="{{route('viewcomplaintId', ['id' => $complaint->reference])}}"
                            type="button"
                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium 
                            rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 
                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 
                            transition-colors duration-200">
                            View Details
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if(count($complaints) === 0)
        <div class="text-center py-6 text-gray-500">
            No complaints found.
        </div>
        @endif
    </div>
</div>