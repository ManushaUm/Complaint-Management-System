<x-app-layout>

<head>
        <meta charset="utf-8" />
        <title>CI Lanka - Complaint Management System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Responsive Table css -->
        <link href="assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />
        <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <x-slot name="header">
        <x-user-profile />
    </x-slot>
    
    <div class="container">
    <div class="row">
        <div class="col-12">
            <!-- Page Title -->
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Full Complaint</h4>
            </div>
        </div>
    </div>

    <!-- Form to Input Complaint ID -->
   

    <!-- Complaint Details Section -->
    <!-- Complaint Details Section -->
@if(isset($complaint))
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Complaint Details</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr><th>Name</th><td>{{ $complaint->name }}</td></tr>
                                <tr><th>Insured</th><td>{{ $complaint->insured ? 'Yes' : 'No' }}</td></tr>
                                <tr><th>Relation</th><td>{{ $complaint->relation ?? 'N/A' }}</td></tr>
                                <tr><th>Address</th><td>{{ $complaint->address }}</td></tr>
                                <tr><th>Contact Number</th><td>{{ $complaint->contact_no }}</td></tr>
                                <tr><th>Email</th><td>{{ $complaint->email }}</td></tr>
                                <tr><th>Customer Type</th><td>{{ $complaint->customer_type ?? 'N/A' }}</td></tr>
                                <tr><th>Policy Number</th><td>{{ $complaint->policy_number ?? 'N/A' }}</td></tr>
                                <tr><th>Complaint Date</th><td>{{ $complaint->complaint_date }}</td></tr>
                                <tr><th>Complaint Details</th><td>{{ $complaint->complaint_detail ?? 'N/A' }}</td></tr>
                                <tr><th>Attachment</th>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif(isset($complaints) && $complaints->isNotEmpty())
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Complaints</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Insured</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($complaints as $comp)
                                    <tr>
                                        <td>{{ $comp->id }}</td>
                                        <td>{{ $comp->name }}</td>
                                        <td>{{ $comp->insured ? 'Yes' : 'No' }}</td>
                                        <td>{{ $comp->contact_no }}</td>
                                        <td>{{ $comp->email }}</td>
                                        <td>
                                            <a href="{{ route('full.complaint', ['id' => $comp->id]) }}" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-warning">No complaints found.</div>
@endif

</div>

   
</x-app-layout>
