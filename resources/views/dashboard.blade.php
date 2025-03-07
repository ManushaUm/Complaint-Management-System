<x-app-layout>
    <x-slot name="slot">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card bg-danger bg-soft p-4">
                            <div>
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-dark p-3">
                                            <h5 class="text-dark">Welcome Back !</h5>
                                            <p>Complaint Dashboard</p>


                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                    <i class="bx bx-copy-alt"></i>
                                                </span>
                                            </div>
                                            <h5 class="font-size-14 mb-0">Total Complaints</h5>
                                        </div>
                                        <div class="text-muted mt-4">
                                            <h4>{{$newComplaintsCount}} <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                    <i class="bx bx-archive-in"></i>
                                                </span>
                                            </div>
                                            <h5 class="font-size-14 mb-0">Received Complaints</h5>
                                        </div>
                                        <div class="text-muted mt-4">
                                            <h4>{{$pendingComplaintsCount}} </h4>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                    <i class="bx bx-purchase-tag-alt"></i>
                                                </span>
                                            </div>
                                            <h5 class="font-size-14 mb-0">Assigned Complaints</h5>
                                        </div>
                                        <div class="text-muted mt-4">
                                            <h4>{{$assignedComplaintsCount}} <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="clearfix">

                                    <h4 class="card-title mb-4">Table view</h4>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="clearfix">

                                    <h4 class="card-title mb-4">Graph View</h4>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body border-bottom">
                                <div class="row">
                                    <div class="col-md-4 col-9">
                                        <h5 class="font-size-15 mb-1">active on system</h5>
                                        <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Active now</p>
                                    </div>

                                </div>
                            </div>



                        </div>
                    </div>

                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
    </x-slot>

    <div class="py-12">

        <body data-sidebar="dark">
            <div class="main-content">


            
    



        </body>
    </div>
</x-app-layout>

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Saas dashboard init -->
<script src="assets/js/pages/saas-dashboard.init.js"></script>

<script src="assets/js/app.js"></script>