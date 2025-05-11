@extends('layouts.app')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Main Dashboard Header -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="mb-0">Complaint Management Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Summary Section -->
        <div class="row">
            <!-- Welcome Card with Quick Stats Summary -->
            <div class="col-xl-4">
                <div class="card bg-primary bg-soft p-0 overflow-hidden">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="p-3">
                                    <h4 class="text-primary mb-2">Welcome Back!</h4>
                                    <p class="text-muted mb-3">Complaint Management System</p>
                                    <div class="d-flex align-items-center mt-4">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm rounded-circle bg-primary">
                                                <i class="bx bx-user font-size-24 text-white text-center h-100 d-flex align-items-center justify-content-center"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="mb-0 font-size-15">Admin Dashboard</h5>
                                            <p class="text-muted mb-0">Real-time overview</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 align-self-end text-end pe-3">
                                <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Stats Cards -->
            <div class="col-xl-8">
                <div class="row">
                    <!-- Total Complaints Card -->
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium mb-2">Total Complaints</p>
                                        <h4 class="mb-0">{{$newComplaintsCount}}</h4>
                                    </div>
                                    <div class="mini-stat-icon avatar-sm align-self-center rounded-circle bg-primary-subtle">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Received Complaints Card -->
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium mb-2">Received Complaints</p>
                                        <h4 class="mb-0">{{$pendingComplaintsCount}}</h4>
                                    </div>
                                    <div class="mini-stat-icon avatar-sm align-self-center rounded-circle bg-warning-subtle">
                                        <span class="avatar-title rounded-circle bg-warning">
                                            <i class="bx bx-archive-in font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-warning" role="progressbar"
                                            style="width: {{ $pendingComplaintsCount > 0 ? ($pendingComplaintsCount / $newComplaintsCount * 100) : 0 }}%"
                                            aria-valuenow="{{ $pendingComplaintsCount > 0 ? ($pendingComplaintsCount / $newComplaintsCount * 100) : 0 }}"
                                            aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Assigned Complaints Card -->
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium mb-2">Assigned Complaints</p>
                                        <h4 class="mb-0">{{$assignedComplaintsCount}}</h4>
                                    </div>
                                    <div class="mini-stat-icon avatar-sm align-self-center rounded-circle bg-success-subtle">
                                        <span class="avatar-title rounded-circle bg-success">
                                            <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-success" role="progressbar"
                                            style="width: {{ $assignedComplaintsCount > 0 ? ($assignedComplaintsCount / $newComplaintsCount * 100) : 0 }}%"
                                            aria-valuenow="{{ $assignedComplaintsCount > 0 ? ($assignedComplaintsCount / $newComplaintsCount * 100) : 0 }}"
                                            aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second row of stats -->
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-0">Complaint Resolution Rate</h5>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-calendar me-1"></i> This Month
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="#">This Week</a></li>
                                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                                <li><a class="dropdown-item" href="#">Last Month</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <div class="progress progress-xl">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $assignedComplaintsCount > 0 ? ($assignedComplaintsCount / $newComplaintsCount * 100) : 0 }}%"
                                            aria-valuenow="{{ $assignedComplaintsCount > 0 ? ($assignedComplaintsCount / $newComplaintsCount * 100) : 0 }}"
                                            aria-valuemin="0"
                                            aria-valuemax="100">
                                            {{ number_format($assignedComplaintsCount > 0 ? ($assignedComplaintsCount / $newComplaintsCount * 100) : 0, 1) }}%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <h4 class="card-title mb-0 flex-grow-1">Recent Activities</h4>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-soft-primary btn-sm">
                                    <i class="bx bx-dots-horizontal-rounded font-size-20"></i>
                                </button>
                            </div>
                        </div>

                        <div class="px-4">
                            <div class="timeline-2">
                                <!-- You can populate this with recent complaint activities dynamically -->
                                <div class="timeline-continue">
                                    <div class="row timeline-right">
                                        <div class="col-md-6">
                                            <div class="timeline-box">
                                                <div class="timeline-date bg-primary text-center rounded">
                                                    <h3 class="text-white mb-0">Today</h3>
                                                </div>
                                                <div class="timeline-content">
                                                    <p class="text-muted mb-0">New complaint received from customer #1245</p>
                                                    <p class="text-muted mb-0 mt-2"><i class="bx bx-time-five me-1"></i> 3 hours ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row timeline-left">
                                        <div class="col-md-6 d-md-none d-block"></div>
                                        <div class="col-md-6">
                                            <div class="timeline-box">
                                                <div class="timeline-date bg-success text-center rounded">
                                                    <h3 class="text-white mb-0">Yesterday</h3>
                                                </div>
                                                <div class="timeline-content">
                                                    <p class="text-muted mb-0">Complaint #1242 assigned to support team</p>
                                                    <p class="text-muted mb-0 mt-2"><i class="bx bx-time-five me-1"></i> 1 day ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Quick Actions</h4>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="avatar-md mb-3">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-plus-medical font-size-24 text-white"></i>
                                        </span>
                                    </div>
                                    <a href="{{route('newcomplaint')}}" class="btn btn-outline-primary w-100">New Complaint</a>
                                </div>
                            </div>



                            <div class="col-md-3">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="avatar-md mb-3">
                                        <span class="avatar-title rounded-circle bg-success">
                                            <i class="bx bx-file font-size-24 text-white"></i>
                                        </span>
                                    </div>
                                    <a href="{{route('reports.view')}}" class="btn btn-outline-success w-100">Generate Report</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>

@endsection

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>