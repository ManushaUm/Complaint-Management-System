@extends('layouts.app')

@section('content')
<div>
    @auth
    @if(Auth::user()->role == 'admin')
    <div class="card mx-auto sm:px-6 lg:px-8">
        <div class="card-body py-10">
            <ul class="nav nav-pills nav-justified" role="tablist">
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link active" data-bs-toggle="tab" href="#approved" role="tab">
                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>

                        <span class="d-none d-sm-block">Approved</span>

                    </a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link" data-bs-toggle="tab" href="#rejected" role="tab">
                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>

                        <span class="d-none d-sm-block">Rejcected</span>

                    </a>
                </li>
            </ul>
            <div class="tab-content p-1 text-muted">
                <div class="tab-pane active" id="approved" role="tabpanel">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">

                                @if(count($approvedFinalLogs) > 0)
                                <x-member-assigned-table :complaints="$approvedFinalLogs" />
                                @else

                                <div class="my-2 p-4 bg-yellow-100 text-yellow-700 rounded-md">
                                    <p class="font-medium"><span><i class="bx bx-info-circle"></i></span> There are no complaints left.</p>
                                </div>

                                @endif


                            </div>
                        </div> <!-- end row -->
                    </div>
                </div>
                <div class="tab-pane" id="rejected" role="tabpanel">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">


                                @if(count($rejectedFinalLogs) > 0)
                                <x-completed-table :complaints="$rejectedFinalLogs" />
                                @else

                                <div class="my-2 p-4 bg-yellow-100 text-yellow-700 rounded-md">
                                    <p class="font-medium"><span><i class="bx bx-info-circle"></i></span> There are no complaints left.</p>
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

    @else

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                @if(count($complaints) > 0)
                <x-member-assigned-table :complaints="$complaints" />
                @else

                <div class="my-2 p-4 bg-yellow-100 text-yellow-700 rounded-md">
                    <p class="font-medium"><span><i class="bx bx-info-circle"></i></span> There are no complaints left.</p>
                </div>

                @endif


            </div>
        </div> <!-- end row -->
    </div>

    @endif

    @endauth
</div>
@endsection