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