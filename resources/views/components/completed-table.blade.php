<div class="container-fluid">
    @auth
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <thead class="bg-slate-700 text-slate-200">
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
                                                    @php
                                                    $user_id = Auth::user()->emp_id;

                                                    @endphp

                                                    @foreach($complaints as $complaint)
                                                    @php
                                                    $tableclass = $complaint->priority == 'high' ? 'table-danger' : 'table-light';

                                                    @endphp
                                                    <tr class="{{$tableclass}}">

                                                        <td>{{ $complaint->name }}</td>
                                                        <td>{{ $complaint->contact_no }}</td>
                                                        <td>{{ $complaint->email }}</td>
                                                        <td>{{ $complaint->customer_type }}</td>
                                                        <td>{{ $complaint->policy_number }}</td>
                                                        <td>{{ $complaint->complaint_date }}</td>

                                                        @if(Auth::user()->role == 'd-head')
                                                        @if( $complaint->is_closed == 1 && $complaint->is_approved == 1 )

                                                        <td>

                                                            <!-- Button trigger modal -->
                                                            <a href="{{route('viewcomplaintId' , ['id' => $complaint->Reference_number])}}" class="w-8 h-8"><i class="bx bx-check-circle text-green-600"></i></a>

                                                        </td>
                                                        @elseif($complaint->is_closed == 1 && $complaint->is_approved == 2)
                                                        <td>

                                                            <!-- Button trigger modal -->
                                                            <a href="{{route('viewcomplaintId' , ['id' => $complaint->Reference_number])}}" class="w-8 h-8"><i class="bx bx-x-circle text-red-600"></i></a>

                                                        </td>
                                                        @else
                                                        <td>
                                                            <!-- Button trigger modal -->
                                                            <a href="{{route('viewcomplaintId' , ['id' => $complaint->Reference_number])}}" class="btn btn-primary btn-sm">View</a>
                                                        </td>
                                                        @endif
                                                        @else
                                                        @if( $complaint->is_closed == '1')

                                                        <td>

                                                            <!-- Button trigger modal -->
                                                            <a href="{{route('viewcomplaintId' , ['id' => $complaint->Reference_number])}}" class="w-8 h-8"><i class="bx bx-check-circle text-green-600"></i></a>

                                                        </td>
                                                        @else
                                                        <td>
                                                            <!-- Button trigger modal -->
                                                            <a href="{{route('viewcomplaintId' , ['id' => $complaint->Reference_number])}}" class="btn btn-primary btn-sm">View</a>
                                                        </td>
                                                        @endif
                                                        @endif
                                                    </tr>

                                                    @endforeach
                                                </tbody>

                                            </table>

                                        </div>
                                        <!-- end table-responsive -->



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
    @endauth
</div>