<x-app-layout>
    <head>
        <meta charset="utf-8" />
        <title>CI Lanka - Complaint Management System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/CI-logo.png">
        

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    </head>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <h4 class="card-title">Welcome {{ Auth::user()->name }} </h4>
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($complaintData)
                        <div class="mb-4">
                            <p class="mb-2"><strong>Name:</strong> {{ $complaintData->name }}</p>
                            <p class="mb-2"><strong>Policy Number:</strong> {{ $complaintData->policy_number }}</p>
                            <p class="mb-2"><strong>Insured:</strong> {{ $complaintData->insured }}</p>
                            <p class="mb-2"><strong>Relation:</strong> {{ $complaintData->relation ?? 'N/A' }}</p>
                            <p class="mb-2"><strong>Address:</strong> {{ $complaintData->address }}</p>
                            <p class="mb-2"><strong>Contact No:</strong> {{ $complaintData->contact_no }}</p>
                            <p class="mb-2"><strong>Email:</strong> {{ $complaintData->email }}</p>
                            <p class="mb-2"><strong>Customer Type:</strong> {{ $complaintData->complaint_type }}</p>
                            <p class="mb-2"><strong>Complaint Date:</strong> {{ $complaintData->complaint_date }}</p>
                            <p class="mb-2"><strong>Complaint Details:</strong> {{ $complaintData->complaint_detail }}</p>
                            <p class="mb-2">
                                <strong>Attachment:</strong>
                                @if ($complaintData->attachment)
                                    <a href="{{ asset('storage/' . $complaintData->attachment) }}" 
                                       class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200"
                                       target="_blank">
                                        View Attachment
                                    </a>
                                @else
                                    No Attachment
                                @endif
                            </p>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('complaints.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to List
                            </a>
                        </div>
                    @else
                        <p>No complaint found with this policy number.</p>
                    @endif
                </div>
            </div>
        </div>

</x-app-layout>
