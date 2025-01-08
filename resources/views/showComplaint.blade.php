<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-400 leading-tight">
            Complaint Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Complaint Information</h3>
                    
                    <p><strong>Customer Name:</strong> {{ $complaint->name }}</p>
                    <p><strong>Policy/Vehicle Number:</strong> {{ $complaint->policy_number }}</p>
                    <p><strong>Complaint Date:</strong> {{ $complaint->complaint_date }}</p>
                    <p><strong>Email:</strong> {{ $complaint->email }}</p>
                    <p><strong>Complaint Details:</strong> {{ $complaint->complaint_detail }}</p>
                    <p><strong>Attachment:</strong> <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank">View Attachment</a></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
