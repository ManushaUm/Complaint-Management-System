<x-app-layout>

    <div class="py-12">


        <body data-sidebar="dark">
            @auth
            <div id="layout-wrapper">
                <div class="card max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="card-body">

                        <!-- Nav tabs -->
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            @if(Session('role') == 'admin')
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home-1" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">New Complaints</span>
                                </a>
                            </li>
                            @endif
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-bs-toggle="tab" href="#profile-1" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    @if(Session('role') == 'admin')
                                    <span class="d-none d-sm-block">Assigned Complaints</span>
                                    @else
                                    <span class="d-none d-sm-block">Received Complaints</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-bs-toggle="tab" href="#messages-1" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">Closed</span>
                                </a>
                            </li>

                        </ul>


                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">

                            @php
                            $className1 = (session('role') == 'admin') ? 'tab-pane active' : 'tab-pane';
                            $className2 = (session('role') == 'head') ? 'tab-pane active' : 'tab-pane';
                            @endphp

                            @if(Session('role') == 'admin')
                            <div class="{{$className1}}" id="home-1" role="tabpanel">
                                <p class="mb-0">
                                    Table of new complaint
                                </p>
                                <div class="container-fluid">
                                    <div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title mb-4">New Complaints</h4>
                                                                        <div class="table-responsive">
                                                                            <table class="table align-middle table-nowrap mb-0">
                                                                                <thead class="table-light">
                                                                                    <tr>
                                                                                        <th>Customer</th>

                                                                                        <th>Contact No</th>
                                                                                        <th>Email</th>
                                                                                        <th>Customer Type</th>
                                                                                        <th>Policy/Vehicle Number</th>
                                                                                        <th>Complaint Date</th>


                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach($complaints as $complaint)
                                                                                    @if($complaint->is_closed == 0 && $complaint->complaint_status == 0)
                                                                                    <tr>
                                                                                        <td>{{ $complaint->name }}</td>

                                                                                        <td>{{ $complaint->contact_no }}</td>
                                                                                        <td>{{ $complaint->email }}</td>
                                                                                        <td>{{ $complaint->customer_type }}</td>
                                                                                        <td>{{ $complaint->policy_number }}</td>
                                                                                        <td>{{ $complaint->complaint_date }}</td>


                                                                                        <td>
                                                                                            <!-- Button trigger modal -->
                                                                                            <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                                                                                                data-bs-toggle="modal"
                                                                                                data-bs-target="#transaction-detailModal"
                                                                                                data-complaint='@json($complaint)'>
                                                                                                View Details
                                                                                            </button>
                                                                                        </td>
                                                                                    </tr>

                                                                                    @endif
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>

                                                                        </div>
                                                                        <!-- end table-responsive -->

                                                                        <!-- Transaction Modal -->


                                                                        <x-complaint-assign-modal :departmentNames="$departmentNames" :divisionNames="$divisionNames" />

                                                                        <!-- end modal -->

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="{{$className2}}" id="profile-1" role="tabpanel">

                                <p class="mb-0">
                                    @if(Session('role') == 'admin')
                                    Table of assigned
                                    @else
                                    Received Complaints
                                    @endif
                                </p>

                                <div class="container-fluid">
                                    <div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title mb-4">New Complaints</h4>
                                                                        <div class="table-responsive">
                                                                            <table class="table align-middle table-nowrap mb-0">
                                                                                <thead class="table-light">
                                                                                    <tr>
                                                                                        <th>Customer</th>

                                                                                        <th>Contact No</th>
                                                                                        <th>Email</th>
                                                                                        <th>Customer Type</th>
                                                                                        <th>Policy/Vehicle Number</th>
                                                                                        <th>Complaint Date</th>


                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>


                                                                                <tbody>

                                                                                    @foreach($complaints as $complaint)

                                                                                    @if($complaint->is_closed == 0 && $complaint->complaint_status == 1)

                                                                                    <tr>
                                                                                        <td>{{ $complaint->name }}</td>
                                                                                        <td>{{ $complaint->contact_no }}</td>
                                                                                        <td>{{ $complaint->email }}</td>
                                                                                        <td>{{ $complaint->customer_type }}</td>
                                                                                        <td>{{ $complaint->policy_number }}</td>
                                                                                        <td>{{ $complaint->complaint_date }}</td>


                                                                                        <td>
                                                                                            <!-- Button trigger modal -->
                                                                                            <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                                                                                                data-bs-toggle="modal"
                                                                                                data-bs-target="#transaction-detailModal"
                                                                                                data-complaint='@json($complaint)'>
                                                                                                View Details
                                                                                            </button>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @endif
                                                                                    @endforeach

                                                                                </tbody>

                                                                            </table>

                                                                        </div>
                                                                        <!-- end table-responsive -->

                                                                        <!-- Transaction Modal -->


                                                                        <x-complaint-assign-modal :departmentNames="$departmentNames" :divisionNames="$divisionNames" />

                                                                        <!-- end modal -->

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="messages-1" role="tabpanel">
                                <p class="mb-0">
                                    Table of closed
                                </p>
                                <div class="container-fluid">
                                    <div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title mb-4">New Complaints</h4>
                                                                        <div class="table-responsive">
                                                                            <table class="table align-middle table-nowrap mb-0">
                                                                                <thead class="table-light">
                                                                                    <tr>
                                                                                        <th>Customer</th>

                                                                                        <th>Contact No</th>
                                                                                        <th>Email</th>
                                                                                        <th>Customer Type</th>
                                                                                        <th>Policy/Vehicle Number</th>
                                                                                        <th>Complaint Date</th>


                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach($complaints as $complaint)
                                                                                    @if($complaint->is_closed ==1)
                                                                                    <tr>
                                                                                        <td>{{ $complaint->name }}</td>

                                                                                        <td>{{ $complaint->contact_no }}</td>
                                                                                        <td>{{ $complaint->email }}</td>
                                                                                        <td>{{ $complaint->customer_type }}</td>
                                                                                        <td>{{ $complaint->policy_number }}</td>
                                                                                        <td>{{ $complaint->complaint_date }}</td>


                                                                                        <td>
                                                                                            <!-- Button trigger modal -->
                                                                                            <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                                                                                                data-bs-toggle="modal"
                                                                                                data-bs-target="#transaction-detailModal"
                                                                                                data-complaint='@json($complaint)'>
                                                                                                View Details
                                                                                            </button>
                                                                                        </td>
                                                                                    </tr>
                                                                                    @endif
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>

                                                                        </div>
                                                                        <!-- end table-responsive -->

                                                                        <!-- Transaction Modal -->


                                                                        <x-complaint-assign-modal :departmentNames="$departmentNames" :divisionNames="$divisionNames" />

                                                                        <!-- end modal -->

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>

                </div>




            </div>
            @endauth

        </body>
    </div>
</x-app-layout>