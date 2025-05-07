@extends('layouts.app')

@section('content')



<div>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Complaint Details</h4>

            </div>
        </div>
    </div>
    <!-- end page title -->

    @foreach ($prevData as $Initcomplaint)

    <div class="row">
        <div class="col-xl-3">
            <!--Complaint overview Card-->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-medium text-gray-800">Complaint Overview</h3>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="divide-y divide-gray-100">
                                <tr>
                                    <th scope="row" class="py-3 text-sm font-medium text-gray-700 w-1/3">Customer</th>
                                    <td class="py-3 text-sm text-gray-600">{{$Initcomplaint->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="py-3 text-sm font-medium text-gray-700">Type</th>
                                    <td class="py-3 text-sm text-gray-600">{{$Initcomplaint->customer_type}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="py-3 text-sm font-medium text-gray-700">Policy Number</th>
                                    <td class="py-3 text-sm text-gray-600">{{$Initcomplaint->policy_number}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="py-3 text-sm font-medium text-gray-700">Status</th>
                                    <td class="py-3">
                                        @if ($Initcomplaint->complaint_status == '1' && $Initcomplaint->is_closed == '0')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                            Assigned
                                        </span>
                                        @elseif ($Initcomplaint->complaint_status == '0' && $Initcomplaint->is_closed == '0')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700">
                                            Received
                                        </span>
                                        @elseif ($Initcomplaint->complaint_status == '0' && $Initcomplaint->is_closed == '1')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700">
                                            Closed
                                        </span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row" class="py-3 text-sm font-medium text-gray-700">Updated on</th>
                                    <td class="py-3 text-sm text-gray-600">{{$Initcomplaint->complaint_date}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="py-3 text-sm font-medium text-gray-700">Brief</th>
                                    <td class="py-3 text-sm text-gray-600">{{$Initcomplaint->complaint_detail}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="mt-4 text-center">
                            <a href="{{ Storage::url($Initcomplaint->attachment)}}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 font-medium rounded transition-colors w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                View Attachments
                            </a>
                        </div>
                        <div class="mt-4 text-center">
                            <a type="button" href="#customerDetails" data-bs-toggle="modal" data-bs-target="#customerDetails" class="inline-flex items-center justify-center px-4 py-2 bg-green-50 hover:bg-blue-100 text-green-600 font-medium rounded transition-colors w-full">

                                Customer Information
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <x-customer-details-modal :initcomplaint="$Initcomplaint" />
            <!--End Complaint overview Card-->

        </div>
        <!--end col-->

        <div class="col-xl-9">
            @if ( $Initcomplaint -> is_approved == 1)
            <div class="my-2 p-4 bg-green-400 text-white">
                <p class="font-medium pt-2"><span><i class="bx bx-check-circle"></i></span> Complaint was approved by Department Head</p>
            </div>
            @elseif($Initcomplaint -> is_approved == 2)
            <div class="my-2 p-4 bg-yellow-200 text-yellow-700">
                <p class="font-medium pt-2"><span><i class="bx bx-x-circle"></i></span> Complaint was rejected by Department Head</p>
            </div>
            @endif
            <div class="card">

                <div class="card-body border-bottom">
                    <div class="d-flex">




                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-semibold font-size-16">Complaint on Reference number <span><a href="#">{{$Initcomplaint->id}}</a></span> </h5>
                            <ul class="list-unstyled hstack gap-2 mb-0">
                                @php

                                $id = $prevData[0]->id;
                                $loggedBy = $newData[0]->Notes_by;
                                $is_approved = $prevData[0]->is_approved;
                                $priority = $prevData[0]->priority;
                                $currentStatus = $newData[sizeof($newData)-1]->Status;
                                $status = $prevData[0]->is_closed == '0' ? 'In-Progress' : 'Closed';
                                $assignedTo = $newData[sizeof($newData)-1]->Assigned_to;
                                $latestComment = $newData[sizeof($newData)-1]->Comment_by;
                                $isClosed = $prevData[sizeof($prevData)-1]->is_closed;


                                if ($priority == 'HIGH') {
                                $className = "badge bg-danger";
                                } elseif ($priority == 'LOW') {
                                $className = "badge bg-warning";
                                } else {
                                $className = "badge bg-success";
                                }

                                if($status == 'In-Progress'){
                                $statusClass = "text-warning";
                                }
                                else{
                                $statusClass = "text-success";
                                }

                                @endphp
                                <li>
                                    <span class="{{$className}}"> <i class="mdi mdi-alert"></i> {{$priority}}</span>
                                </li>
                                <li>
                                    <span class="{{$statusClass}}"> {{$status}}</span>
                                </li>

                            </ul>
                            <ul class="list-unstyled hstack gap-2 mb-0">
                                <li>
                                    <i class="mdi mdi-account"></i> <span class="text-muted">Complaint logged by <span><a href="{{ route('user', ['id' => $loggedBy]) }}">{{$loggedBy}}</a></span></span>
                                </li>
                            </ul>

                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                        </div>
                        <li class="list-inline-item mt-1">
                            @if ($assignedTo == NULL)
                            <form action="{{route('assign-job' , ['id' => $id])}}" method="POST">
                                @csrf
                                <button href="" class="btn btn-outline-primary btn-hover"><i class="bx bx-briefcase"></i> Take the job</button>
                            </form>

                            @else
                            <a href="javascript:void(0)">
                                @if ( Auth::user()->emp_id == $assignedTo)
                                Assigned to you</a>
                            @else
                            <a href="{{ route('user', ['id' => $assignedTo]) }}"></a>Assigned to {{$assignedTo}}</a>
                            @endif
                            @endif
                        </li>
                    </div>
                </div>
                <div class="card-body">

                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                        <h3 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m-3-3H9m0 0V8m0 4h3m0 0l-3-3m3 3l3 3m-6-4h6" />
                            </svg>
                            Notes for the Complaint
                        </h3>
                        <div class="space-y-4">
                            @foreach($newData as $complaintLog)
                            <div class="border-b border-gray-100 pb-4 last:border-b-0 last:pb-0">
                                <div class="flex">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 w-full">
                                        <div class="flex items-center justify-between mb-1">
                                            <h4 class="text-sm font-medium text-gray-800">
                                                <a href="{{ route('user', ['id' => $complaintLog->Notes_by]) }}" class="hover:text-blue-600 transition-colors">
                                                    {{$complaintLog->Notes_by}}
                                                </a>
                                            </h4>
                                            <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-600">
                                                {{$complaintLog->Status}}
                                            </span>
                                        </div>

                                        <p class="text-sm text-gray-600 mb-3">{{$complaintLog->Notes}}</p>

                                        <div class="flex items-center text-xs space-x-1">
                                            <a href="javascript: void(0);" class="inline-flex items-center text-green-600 hover:text-green-700 px-2 py-1 rounded hover:bg-gray-50 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                                </svg>
                                                Contact
                                            </a>

                                            @if($complaintLog->Attachment !== NULL)
                                            <a href="{{ Storage::url($complaintLog->Attachment)}}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-700 px-2 py-1 rounded hover:bg-gray-50 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                                </svg>
                                                Attachments
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="flex py-4">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 w-full">
                                        <div class="flex items-center justify-between mb-1">
                                            <h4 class="text-sm font-medium text-gray-800">
                                                <a href="{{ route('user', ['id' => $complaintLog->Notes_by]) }}" class="hover:text-blue-600 transition-colors">
                                                    {{$complaintLog->Comment_by}}
                                                </a>
                                            </h4>
                                            <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-600">
                                                {{$complaintLog->Status}}
                                            </span>
                                        </div>

                                        <p class="text-sm text-gray-600 mb-3">{{$complaintLog->Comment}}</p>

                                        <div class="flex items-center text-xs space-x-1">
                                            <a href="javascript: void(0);" class="inline-flex items-center text-green-600 hover:text-green-700 px-2 py-1 rounded hover:bg-gray-50 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                                </svg>
                                                Contact
                                            </a>

                                            @if($complaintLog->Attachment !== NULL)
                                            <a href="{{ Storage::url($complaintLog->Attachment)}}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-700 px-2 py-1 rounded hover:bg-gray-50 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                                </svg>
                                                Attachments
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-4">
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error in submitting:</strong> Please fix the following issues:
                            <ul>
                                @foreach ($errors->all() as $error)
                                @if($error == 'The commentmessage-input field is required.')
                                <li>Please Enter the Solution as a text</li>
                                @endif
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if ($assignedTo == '')
                        <p class="text-muted">Please take the job to start</p>
                        @endif

                        @if ( Auth::user()->emp_id == $assignedTo && ($currentStatus =='in-progress' || $currentStatus == 'In-Progress') && $latestComment == NULL)

                        <!--Action Card-->
                        <x-complaint-action-form id="{{$id}}" />


                        @elseif($complaintLog->Status == 'Solved' && $is_approved == 0)
                        <p class=" text-blue-500">Complaint was submitted for review by {{$complaintLog->Comment_by}} </p>

                        @elseif($complaintLog->Status == 'Closed' && $is_approved == 0)
                        <p class=" text-green-500"> Job Closed by <span><a href="#">{{$complaintLog->Assigned_to}}</a></span></p>

                        @elseif ( Auth::user()->emp_id !== $assignedTo && $assignedTo !== null && $is_approved == 0)
                        <p class="text-muted">This issue was assigned to <a href="#">{{$assignedTo}}</a></p>

                        @elseif($is_approved == 1)
                        <p class="text-muted">This issue was approved by the department head</p>
                        @endif

                        <!--HERE -->
                        @if (Auth::user()->role == 'head')
                        @if ($currentStatus == 'Solved' && $isClosed == 0 && $prevData[0]->complaint_status == 1)
                        <div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-primary waves-effect waves-light mx-2" data-bs-toggle="modal" data-bs-target="#complaintAction">Close Job</button>
                                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#complaintOpen">Reopen Job</button>
                            </div>

                            <!-- Complaint Closing Model-->
                            <x-head-complaint-closing-modal :id="$id" :prevData="$prevData" :newData="$newData" />
                            <!-- /.modal -->
                            <!-- Complaint Reopen Model-->
                            <x-head-complaint-reopen-model :id="$id" :prevData="$prevData" :newData="$newData" />
                            <!-- /.modal -->
                        </div>
                        @endif

                        @elseif (Auth::user()->role == 'd-head')

                        @if ($is_approved == 0 && $currentStatus == 'Solved')

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary waves-effect waves-light mx-2" data-bs-toggle="modal" data-bs-target="#complaintAction">Action</button>
                            <!-- Complaint Closing Model-->
                            <x-head-complaint-closing-modal :id="$id" :prevData="$prevData" :newData="$newData" />
                        </div>
                        @endif
                        @endif

                        @if (Auth::user()->role == 'admin')
                        @if ($is_approved == 1 || $is_approved ==2)
                        <!--Admin Reopen -->
                        <div>
                            <div class="d-flex justify-content-end">

                                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#complaintOpen">Reopen Job</button>
                            </div>

                            <!-- Complaint Closing Model-->
                            <x-head-complaint-closing-modal :id="$id" :prevData="$prevData" :newData="$newData" />
                            <!-- /.modal -->
                            <!-- Complaint Reopen Model-->
                            <x-head-complaint-reopen-model :id="$id" :prevData="$prevData" :newData="$newData" />
                            <!-- /.modal -->
                        </div>

                        @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    @endforeach
    <!--end row-->
</div>


<!-- JAVASCRIPT -->
<script src="http://skote-v.laravel.themesbrand.com/assets/libs/jquery/jquery.min.js"></script>
<script src="http://skote-v.laravel.themesbrand.com/assets/libs/bootstrap/bootstrap.min.js"></script>
<script src="http://skote-v.laravel.themesbrand.com/assets/libs/metismenu/metismenu.min.js"></script>
<script src="http://skote-v.laravel.themesbrand.com/assets/libs/simplebar/simplebar.min.js"></script>
<script src="http://skote-v.laravel.themesbrand.com/assets/libs/node-waves/node-waves.min.js"></script>
<script>
    $('#change-password').on('submit', function(event) {
        event.preventDefault();
        var Id = $('#data_id').val();
        var current_password = $('#current-password').val();
        var password = $('#password').val();
        var password_confirm = $('#password-confirm').val();
        $('#current_passwordError').text('');
        $('#passwordError').text('');
        $('#password_confirmError').text('');
        $.ajax({
            url: "http://skote-v.laravel.themesbrand.com/update-password" + "/" + Id,
            type: "POST",
            data: {
                "current_password": current_password,
                "password": password,
                "password_confirmation": password_confirm,
                "_token": "gOjAkoERvAYNjqQ7xD9QoJEp0JJcX6v6kFrUkZR6",
            },
            success: function(response) {
                $('#current_passwordError').text('');
                $('#passwordError').text('');
                $('#password_confirmError').text('');
                if (response.isSuccess == false) {
                    $('#current_passwordError').text(response.Message);
                } else if (response.isSuccess == true) {
                    setTimeout(function() {
                        window.location.href = "http://skote-v.laravel.themesbrand.com";
                    }, 1000);
                }
            },
            error: function(response) {
                $('#current_passwordError').text(response.responseJSON.errors.current_password);
                $('#passwordError').text(response.responseJSON.errors.password);
                $('#password_confirmError').text(response.responseJSON.errors.password_confirmation);
            }
        });
    });
</script>
<script src="../../../assets/libs/dropzone/min/dropzone.min.js"></script>

<!-- jquery step -->
<script src="../../../assets/libs/jquery-steps/build/jquery.steps.min.js"></script>

<!-- form wizard init -->
<script src="../../../assets/js/pages/form-wizard.init.js"></script>
<script src="../../../assets/js/app.js"></script>


@endsection