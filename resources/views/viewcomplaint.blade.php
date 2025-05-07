@extends('layouts.app')
<x-slot name="slot">
    @section('content')
    @auth

    <div id="layout-wrapper">
        <div class="card mx-auto sm:px-6 lg:px-8">
            <div class="card-body py-10">

                <!-- Nav tabs menu  Admin and Heads-->
                @php
                $activeclass1 = (session('role') == 'admin') ? 'nav-link active' : 'nav-link';
                $activeclass2 = (session('role') == 'head' || session('role') == 'd-head') ? 'nav-link active' : 'nav-link';
                @endphp

                @if(Session('role') == 'admin' || Session('role') == 'head' || Session('role') == 'd-head')
                <ul class="nav nav-pills nav-justified" role="tablist">

                    @if(Session('role') == 'admin')
                    <li class="nav-item waves-effect waves-light">
                        <a class="{{$activeclass1}}" data-bs-toggle="tab" href="#new-complaints" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i> </span>
                            <span class="d-none d-sm-block">New</span>
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-bs-toggle="tab" href="#admin-assigned-complaint" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i> </span>
                            <span class="d-none d-sm-block">To-do</span>
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-bs-toggle="tab" href="#closed-complaints" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <span class="d-none d-sm-block">In-Progress</span>
                        </a>
                    </li>
                    @endif

                    @if(Session('role') == 'head' || Session('role') == 'd-head')
                    <li class="nav-item waves-effect waves-light">
                        <a class="{{$activeclass2}}" data-bs-toggle="tab" href="#received-complaints" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>

                            <span class="d-none d-sm-block">Received Complaints</span>

                        </a>
                    </li>

                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-bs-toggle="tab" href="#assigned-complaints" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>

                            <span class="d-none d-sm-block">Assigned Complaints</span>

                        </a>
                    </li>

                    @endif

                </ul>
                @endif

                <!-- Tab panes Admins and Heads-->
                <div class="tab-content p-1 text-muted">

                    @php
                    $className1 = (session('role') == 'admin') ? 'tab-pane active' : 'tab-pane';
                    $className2 = (session('role') == 'head' || session('role') == 'd-head') ? 'tab-pane active' : 'tab-pane';
                    @endphp

                    <!--Admin new complaints Table -->
                    @if(Session('role') == 'admin')
                    <div class="{{$className1}}" id="new-complaints" role="tabpanel">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!--New Complaints Table -->
                                    <x-admin-new-complaint-table :complaints="$newComplaints" :departmentNames="$departmentNames" :divisionNames="$divisionNames" />
                                    <!-- End Table -->
                                </div>
                            </div> <!-- end row -->
                        </div>
                    </div>
                    @endif

                    <!--Department/Division heads received Table -->
                    <div class="{{$className2}}" id="received-complaints" role="tabpanel">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(count($receivedComplaints) > 0)
                                    <x-complaint-view-table :complaints="$receivedComplaints" :departmentNames="$departmentNames" :divisionNames="$divisionNames" />
                                    @else

                                    <div class="my-2 p-4 bg-yellow-100 text-yellow-700 rounded-md">
                                        <p class="font-medium"><span><i class="bx bx-info-circle"></i></span> There are no received complaints left.</p>
                                    </div>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Admin Assigned Table -->
                    <div class="tab-pane" id="admin-assigned-complaint" role="tabpanel">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(count($adminAssigned) > 0)
                                    <x-complaint-view-table :complaints="$adminAssigned" :departmentNames="$departmentNames" :divisionNames="$divisionNames" />
                                    @else

                                    <div class="my-2 p-4 bg-yellow-100 text-yellow-700 rounded-md">
                                        <p class="font-medium"><span><i class="bx bx-info-circle"></i></span> There are no assigned complaints left.</p>
                                    </div>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>



                    <!--Department/Division heads Assigned Table -->
                    <div class="tab-pane" id="assigned-complaints" role="tabpanel">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(count($assignedComplaints) > 0)
                                    <x-complaint-view-table :complaints="$assignedComplaints" :departmentNames="$departmentNames" :divisionNames="$divisionNames" />
                                    @else

                                    <div class="my-2 p-4 bg-yellow-100 text-yellow-700 rounded-md">
                                        <p class="font-medium"><span><i class="bx bx-info-circle"></i></span> There are no assigned complaints left.</p>
                                    </div>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--Department/Division heads Closed Complaints Table-->
                    <div class="tab-pane" id="closed-complaints" role="tabpanel">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(count($adminOngoing) > 0)
                                    <x-complaint-view-table :complaints="$adminOngoing" :departmentNames="$departmentNames" :divisionNames="$divisionNames" />
                                    @else
                                    <div class="page-content">
                                        <div class="my-2 p-4 bg-yellow-100 text-yellow-700 rounded-md">
                                            <p class="font-medium"><span><i class="bx bx-info-circle"></i></span> There are no closed complaints left.</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Member assigned complaints -->
                @if(Session('role') == 'member')
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            @if(count($receivedComplaints) > 0)

                            <x-complaint-view-table :complaints="$receivedComplaints" :departmentNames="$departmentNames" :divisionNames="$divisionNames" />
                            @else

                            <div class="my-2 p-4 bg-yellow-100 text-yellow-700 rounded-md">
                                <p class="font-medium"><span><i class="bx bx-info-circle"></i></span> There are no received complaints left.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </div>

        @endauth
        @endsection
</x-slot>