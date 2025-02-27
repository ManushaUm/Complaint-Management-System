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
                                        <h4 class="card-title mb-4">Your Complaints</h4>
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
                                                            <a href="#" class="btn btn-primary btn-sm">View</a>
                                                        </td>
                                                    </tr>
                                                    @endif
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
</div>