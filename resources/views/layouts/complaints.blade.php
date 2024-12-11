<!-- resources/views/complaints/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Complaint Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Complaint Information</h3>

                    <p><strong>Name:</strong> {{ $complaintData['name'] }}</p>
                    <p><strong>Insured:</strong> {{ $complaintData['insured'] }}</p>
                    <p><strong>Relation (if not insured):</strong> {{ $complaintData['relation'] ?? 'N/A' }}</p>
                    <p><strong>User ID:</strong> {{ $complaintData['user_id'] }}</p>
                    <p><strong>Address:</strong> {{ $complaintData['address'] }}</p>
                    <p><strong>Contact No:</strong> {{ $complaintData['contact_no'] }}</p>
                    <p><strong>Email:</strong> {{ $complaintData['email'] }}</p>
                    <p><strong>Complaint Type:</strong> {{ $complaintData['customer_type'] }}</p>
                    <p><strong>Policy Number:</strong> {{ $complaintData['policy_number'] }}</p>
                    <p><strong>Date of Complaint:</strong> {{ $complaintData['complaint_date'] }}</p>
                    <p><strong>Complaint Details:</strong> {{ $complaintData['complaint_detail'] }}</p>
                    
                    @if (!empty($complaintData['attachment']))
                        <p><strong>Attachment:</strong> <a href="{{ asset('storage/' . $complaintData['attachment']) }}" target="_blank">View Attachment</a></p>
                    @else
                        <p><strong>Attachment:</strong> None</p>
                    @endif

                    <a href="{{ route('complaints.store') }}" class="btn btn-primary mt-4">Go Back to Form</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
