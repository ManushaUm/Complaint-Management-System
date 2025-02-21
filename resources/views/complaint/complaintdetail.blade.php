<x-app-layout>
    <x-slot name="slot">

        <body data-sidebar="dark">

            <div>
                <div class="page-content">
                    <div class="container-fluid">

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
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="fw-semibold">Complaint Overview</h5>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th scope="col">Customer</th>
                                                        <td scope="col">{{$Initcomplaint->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Type</th>
                                                        <td>{{$Initcomplaint->customer_type}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Policy Number</th>
                                                        <td>{{$Initcomplaint->policy_number}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Status</th>
                                                        @if ($Initcomplaint->complaint_status == '1' && $Initcomplaint->is_closed == '0')
                                                        <td><span class="badge badge-soft-info">Assigned</span></td>
                                                        @else
                                                        <td><span class="badge badge-soft-success">Closed</span></td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Logged date</th>
                                                        <td>{{$Initcomplaint->complaint_date}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Updated on</th>
                                                        <td>{{$Initcomplaint->complaint_date}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <!--End Complaint overview Card-->
                                <!--Complaint Brief Card-->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <h5 class="mt-3 mb-1">Complaint Brief</h5>

                                        </div>

                                        <ul class="list-unstyled mt-4">
                                            <li>
                                                <div class="d-flex">
                                                    <i class="bx bx-receipt text-primary fs-4"></i>
                                                    <div class="ms-3">
                                                        <h6 class="fs-14 mb-2">Detail</h6>
                                                        <p class="text-muted fs-14 mb-0">{{$Initcomplaint->complaint_detail}}</p>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                        <div class="mt-4">
                                            <a href="#!" class="btn btn-soft-primary btn-hover w-100 rounded"><i class="bx bx-paperclip"></i> View Attachments</a>
                                        </div>
                                    </div>
                                </div>
                                <!--End Complaint Brief Card-->
                                <!--Customer contact info Card-->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <h5 class="mt-3 mb-1">Customer contact info</h5>

                                        </div>

                                        <ul class="list-unstyled mt-4">
                                            <li>
                                                <div class="d-flex">
                                                    <i class="bx bx-phone text-primary fs-4"></i>
                                                    <div class="ms-3">
                                                        <h6 class="fs-14 mb-2">Phone</h6>
                                                        <p class="text-muted fs-14 mb-0">{{$Initcomplaint->contact_no}}</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mt-3">
                                                <div class="d-flex">
                                                    <i class="bx bx-mail-send text-primary fs-4"></i>
                                                    <div class="ms-3">
                                                        <h6 class="fs-14 mb-2">Email</h6>
                                                        <p class="text-muted fs-14 mb-0">{{$Initcomplaint->email}}</p>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="mt-3">
                                                <div class="d-flex">
                                                    <i class="bx bx-map text-primary fs-4"></i>
                                                    <div class="ms-3">
                                                        <h6 class="fs-14 mb-2">Location</h6>
                                                        <p class="text-muted fs-14 mb-0">{{$Initcomplaint->address}}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="mt-4">
                                            <a href="#!" class="btn btn-soft-primary btn-hover w-100 rounded"><i class="mdi mdi-eye"></i> View Profile</a>
                                        </div>
                                    </div>
                                </div>
                                <!--End Customer contact info Card-->

                            </div>
                            <!--end col-->
                            <div class="col-xl-9">
                                <div class="card">
                                    <div class="card-body border-bottom">
                                        <div class="d-flex">

                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="fw-semibold font-size-16">Complaint on Reference number <span><a href="#">{{$Initcomplaint->id}}</a></span> </h5>
                                                <ul class="list-unstyled hstack gap-2 mb-0">
                                                    @php
                                                    $id = $prevData[0]->id;
                                                    $loggedBy = $prevData[0]->logged_by;
                                                    $priority = $newData[sizeof($newData)-1]->Priority;
                                                    $status = $prevData[0]->is_closed == '0' ? 'In-Progress' : 'Closed';
                                                    $assignedTo = $newData[sizeof($newData)-1]->Assigned_to;
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
                                                        <i class="mdi mdi-account"></i> <span class="text-muted">Complaint logged by <span><a href="#">{{$loggedBy}}</a></span></span>
                                                    </li>
                                                </ul>
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
                                                <a href="javascript:void(0)"></a>Assigned to {{$assignedTo}}</a>
                                                @endif
                                                @endif
                                            </li>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="mt-2">
                                            <h5 class="font-size-15"><i class="bx bx-message-dots text-muted align-middle me-1"></i> Notes for the Complaint</h5>
                                            @foreach($newData as $complaintLog)
                                            <div>
                                                <div class="d-flex py-3">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <div class="avatar-title rounded-circle bg-light text-primary">
                                                                <i class="bx bxs-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-14 mb-1"><span><a href="#">{{$complaintLog->Notes_by}}</a></span> <small class="text-muted float-end badge badge-soft-info">{{$complaintLog->Status}}</small></h5>
                                                        <p class="text-muted">{{$complaintLog->Notes}}</p>
                                                        <div>
                                                            <a href="javascript: void(0);" class="text-success px-2"><i class="mdi mdi-reply px-1"></i> Reply</a>
                                                            <a href="javascript: void(0);" class="text-primary px-2"><i class="bx bxs-file px-1"></i> Attachments</a>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                            <div>
                                                @if($complaintLog->Comment_by !== NULL)
                                                <div class="d-flex py-3">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-xs">
                                                            <div class="avatar-title rounded-circle bg-light text-primary">
                                                                <i class="bx bxs-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-14 mb-1"><span><a href="#">{{$complaintLog->Comment_by}}</a></span> <small class="text-muted float-end badge badge-soft-info">{{$complaintLog->Status}}</small></h5>
                                                        <p class="text-muted">{{$complaintLog->Comment}}</p>
                                                        <div>
                                                            <a href="javascript: void(0);" class="text-success px-2"><i class="mdi mdi-reply px-1"></i> Reply</a>
                                                            <a href="javascript: void(0);" class="text-primary px-2"><i class="bx bxs-file px-1"></i> Attachments</a>
                                                        </div>
                                                    </div>

                                                </div>
                                                @endif

                                            </div>
                                            @endforeach
                                        </div>

                                        <div class="mt-4">

                                            @if ($assignedTo == 'NULL'){
                                            <p class="text-muted">Please Take the job to start</p>
                                            }

                                            @elseif ( Auth::user()->emp_id == $assignedTo)

                                            @if ($complaintLog->Status !== 'Solved')
                                            <!--Action Card-->
                                            <x-complaint-action-form id="{{$id}}" />

                                            @elseif($complaintLog->Status == 'Solved' && $status == 'In-Progress')
                                            <p class=" text-blue-500">Complaint was submitted for review by {{$complaintLog->Comment_by}} </p>
                                            @elseif($complaintLog->Status == 'Solved' && $status == 'Closed')
                                            <p class=" text-green-500"> Job Closed </p>
                                            @endif

                                            @elseif ( Auth::user()->emp_id !== $assignedTo)
                                            <p class="text-muted">This issue was already took by <a href="#">{{$assignedTo}}</a></p>
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
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

            </div>





            <!-- JAVASCRIPT -->
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

            <script src="http://skote-v.laravel.themesbrand.com/assets/js/app.min.js"></script>

            <!-- App js -->
            <script src="http://skote-v.laravel.themesbrand.com/assets/js/app.min.js"></script>

        </body>
    </x-slot>
</x-app-layout>