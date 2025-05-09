@auth
<div x-data="complaintFilter({{ json_encode($complaints) }})" class="bg-white shadow-md rounded-lg overflow-hidden">
    <!-- Filter section remains the same -->

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Policy/Vehicle Number</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Complaint Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($complaints as $complaint)
                <tr class="hover:bg-gray-50 transition-colors duration-200 
                        {{ $complaint->priority == 'high' ? 'bg-red-50' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $complaint->name ?? 'N/A' }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">
                            {{ $complaint->contact_no ?? 'N/A' }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $complaint->customer_type == 1 ? 'bg-green-100 text-green-800' : 
                                   ($complaint->customer_type == 2 ? 'bg-yellow-100 text-yellow-800' : 
                                   'bg-blue-100 text-blue-800') }}">
                            {{ $complaint->customer_type ?? 'N/A' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $complaint->policy_number ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">
                            {{ $complaint->complaint_date ?? 'N/A' }}
                        </div>
                    </td>

                    @if(Auth::user()->role == 'd-head' || Auth::user()->role == 'head')

                    @if($complaint->is_closed == '1' && $complaint->is_approved == 1)
                    <td>
                        <a href="{{ route('viewcomplaintId', ['id' => $complaint->Reference_number]) }}" class="w-8 h-8">
                            <span class="flex justify-center"><i class="bx bx-check-circle text-green-600 text-xl"></i></span>
                        </a>
                    </td>
                    @elseif($complaint->is_closed == '1' && $complaint->is_approved == 2)
                    <td>
                        <a href="{{ route('viewcomplaintId', ['id' => $complaint->Reference_number]) }}" class="w-8 h-8">
                            <span class="flex justify-center"> <i class="bx bx-x-circle text-red-600 text-xl"></i></span>
                        </a>
                    </td>
                    @else
                    <td>
                        <span class="flex justify-center">
                            <a href="{{ route('viewcomplaintId', ['id' => $complaint->Reference_number]) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium 
                                    rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 
                                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 
                                    transition-colors duration-200">View</a>
                        </span>
                    </td>
                    @endif
                    @else
                    <td>
                        <span class="flex justify-center">
                            <a href="{{ route('viewcomplaintId', ['id' => $complaint->Reference_number]) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium 
                                    rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 
                                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 
                                    transition-colors duration-200">View</a>
                        </span>
                    </td>
                    @endif





                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-500">
                        No complaints found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endauth