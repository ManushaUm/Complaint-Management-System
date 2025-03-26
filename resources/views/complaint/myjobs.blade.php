<x-app-layout>
    <x-slot name="slot">
        <div class="page-content">
            @auth
            @if(Session('role') == 'head' || Session('role') == 'd-head')
            <div class="card mx-auto sm:px-6 lg:px-8">
                <div class="card-body py-10">
                    <ul class="nav nav-pills nav-justified" role="tablist">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active" data-bs-toggle="tab" href="#ongoing" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>

                                <span class="d-none d-sm-block">On-going jobs</span>

                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-bs-toggle="tab" href="#completed-complaints" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>

                                <span class="d-none d-sm-block">Completed Complaints</span>

                            </a>
                        </li>
                    </ul>
                    <div class="tab-content p-1 text-muted">
                        <div class="tab-pane active" id="ongoing" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!--New Complaints Table -->
                                        @if(count($ongoingComplaints) > 0)
                                        <x-member-assigned-table :complaints="$ongoingComplaints" />
                                        @else

                                        <div class="my-2 p-4 bg-yellow-100 text-yellow-700 rounded-md">
                                            <p class="font-medium"><span><i class="bx bx-info-circle"></i></span> There are no assigned complaints.</p>
                                        </div>

                                        @endif
                                        <!-- End Table -->
                                    </div>
                                </div> <!-- end row -->
                            </div>
                        </div>
                        <div class="tab-pane" id="completed-complaints" role="tabpanel">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!--New Complaints Table -->
                                        @if(count($completedComplaints) > 0)
                                        <x-completed-table :complaints="$completedComplaints" />
                                        @else

                                        <div class="my-2 p-4 bg-yellow-100 text-yellow-700 rounded-md">
                                            <p class="font-medium"><span><i class="bx bx-info-circle"></i></span> There are no assigned complaints.</p>
                                        </div>

                                        @endif
                                        <!-- End Table -->
                                    </div>
                                </div> <!-- end row -->
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <!--Member VIEW-->
            @else

            <div class="col-lg-12">

                @if(count($ongoingComplaints) > 0)
                <x-member-assigned-table :complaints="$ongoingComplaints" />
                @else

                <div class="my-2 p-4 bg-yellow-100 text-yellow-700 rounded-md">
                    <p class="font-medium"><span><i class="bx bx-info-circle"></i></span> There are no assigned complaints.</p>
                </div>

                @endif
                <!-- End Table -->
            </div>

            @endif
            @endauth

        </div>
    </x-slot>
</x-app-layout>