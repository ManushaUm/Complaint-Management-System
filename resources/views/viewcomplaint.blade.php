<x-app-layout>
    <x-slot name="slot">
        <div class="py-12">
            @auth
            <div id="layout-wrapper">
                <div class="card mx-auto sm:px-6 lg:px-8">
                    <div class="card-body py-10">

                        <!-- Nav tabs  Admin and Heads-->
                        @php
                        $activeclass1 = (session('role') == 'admin') ? 'nav-link active' : 'nav-link';
                        $activeclass2 = (session('role') == 'head') ? 'nav-link active' : 'nav-link';
                        @endphp

                        @if(Session('role') == 'admin' || Session('role') == 'head')

                        <ul class="nav nav-pills nav-justified" role="tablist">

                            @if(Session('role') == 'admin')
                            <li class="nav-item waves-effect waves-light">
                                <a class="{{$activeclass1}}" data-bs-toggle="tab" href="#new-complaints" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i> </span>
                                    <span class="d-none d-sm-block">New Complaints</span>
                                </a>
                            </li>
                            @endif

                            @if(Session('role') == 'head')
                            <li class="nav-item waves-effect waves-light">
                                <a class="{{$activeclass2}}" data-bs-toggle="tab" href="#received-complaints" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                   
                                    <span class="d-none d-sm-block">Received Complaints</span>
                                   
                                </a>
                            </li>

                            @endif
                            
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-bs-toggle="tab" href="#assigned-complaints" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                   
                                    <span class="d-none d-sm-block">Assigned Complaints</span>
                                    
                                </a>
                            </li>

                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-bs-toggle="tab" href="#closed-complaints" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">Closed</span>
                                </a>
                            </li>
                        </ul>
                        @endif
                        <!-- Tab panes Admins and Heads-->
                        <div class="tab-content p-1 text-muted">

                            @php
                            $className1 = (session('role') == 'admin') ? 'tab-pane active' : 'tab-pane';
                            $className2 = (session('role') == 'head') ? 'tab-pane active' : 'tab-pane';
                            @endphp

                            @if(Session('role') == 'admin')
                            <div class="{{$className1}}" id="new-complaints" role="tabpanel">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <!--New Complaints Table -->
                                            <x-complaint-view-table :complaints="$newComplaints" :departmentNames="$departmentNames" :divisionNames="$divisionNames" />
                                            <!-- End Table -->
                                        </div>
                                    </div>           <!-- end row -->
                                </div>
                            </div>
                            @endif

                            <div class="{{$className2}}" id="received-complaints" role="tabpanel">

                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <x-complaint-view-table :complaints="$receivedComplaints" :departmentNames="$departmentNames" :divisionNames="$divisionNames" />
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane" id="assigned-complaints" role="tabpanel">

                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <x-complaint-view-table :complaints="$assignedComplaints" :departmentNames="$departmentNames" :divisionNames="$divisionNames" />
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Closed Complaints Table-->
                            <div class="tab-pane" id="closed-complaints" role="tabpanel">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <x-complaint-view-table :complaints="$solvedComplaints" :departmentNames="$departmentNames" :divisionNames="$divisionNames" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Member assigned complaints -->
                            @if(Session('role') == 'member')
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <x-complaint-view-table :complaints="$newComplaints" :departmentNames="$departmentNames" :divisionNames="$divisionNames" />
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endauth


        </div>
    </x-slot>
</x-app-layout>