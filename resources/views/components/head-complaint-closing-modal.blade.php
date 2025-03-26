@auth
<div id="complaintAction" class="modal fade" tabindex="-1" aria-labelledby="complaintActionLabel" aria-hidden="true">
    @if(Auth::user()->role == 'head')
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="complaintActionLabel"><span class="card-title">Complaint Closing</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <form action="{{route('closeComplaint' , ['id' => $id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <p>Complaint on Reference number : {{$prevData[0]->id}}</p>
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary mb-0">

                                    <tbody>
                                        <tr>

                                            <th>Policy Number</th>
                                            <td scope="row">{{$prevData[0]->policy_number}}</td>

                                        </tr>
                                        <tr>
                                            <th>Received</th>
                                            <td scope="row">{{$prevData[0]->complaint_date}}</td>

                                        </tr>
                                        <tr>
                                            <th>Last Check</th>
                                            <td scope="row">{{$newData[sizeof($newData)-1]->Assigned_to}}</td>

                                        </tr>
                                        <tr>
                                            <th>Submitted on</th>
                                            <td scope="row">{{$newData[sizeof($newData)-1]->updated_at}}</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    <div class=" mb-3">
                        <label for="headNote" class="col-form-label">Notes</label>
                        <textarea class="form-control my-2" id="headNote" name="headNote"></textarea>

                        <input class="form-control form-control-sm" name="formFileSm" id="formFileSm" type="file">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Close Job</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

    @elseif(Auth::user()->role == 'd-head')
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="complaintActionLabel"><span class="card-title">Complaint actions on <a href="#"> {{$prevData[0]->policy_number}} </a> </span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="card">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#approval" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Approval</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#reject" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Reject</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane active" id="approval" role="tabpanel">
                            <form action="{{route('closeComplaint' , ['id' => $id])}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class=" mb-3">
                                    <label for="headNote" class="col-form-label">Final notes</label>
                                    <textarea class="form-control my-2" id="headNote" name="headNote"></textarea>

                                    <input class="form-control form-control-sm" id="formFileSm" name="formFileSm" type="file">
                                </div>
                                <button type="submit" class="btn btn-success waves-effect waves-light">Approve</button>
                            </form>

                        </div>
                        <div class="tab-pane" id="reject" role="tabpanel">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Reject</a>
                                        <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Reopen</a>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                            <form action="{{route('rejectComplaint' , ['id' => $id])}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class=" mb-3">
                                                    <label for="headNote" class="col-form-label">Final notes</label>
                                                    <textarea class="form-control my-2" id="headNote" name="headNote"></textarea>

                                                    <input class="form-control form-control-sm" name="formFileSm" id="formFileSm" type="file">
                                                    <div class="form-check mb-3 py-2">
                                                        <input class="form-check-input" type="checkbox" id="userUpdate">
                                                        <label class="form-check-label" for="userUpdate">
                                                            Notify {{$prevData[0]->logged_by}} rejection notice
                                                        </label>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-danger waves-effect waves-light">Reject</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                            <form action="{{route('logcomplaint' , ['id' => $id, 'newData' => $newData])}}" method="POST" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class=" mb-3">
                                                    <label for="headNote" class="col-form-label">Remarks</label>
                                                    <textarea class="form-control my-2" id="headNote" name="headNote"></textarea>

                                                    <input class="form-control form-control-sm" name="formFileSm" id="formFileSm" type="file">

                                                    <div class="form-check mb-3 py-2">
                                                        <input class="form-check-input" name="checkbox" type="checkbox" id="userUpdate" value="{{$newData[sizeof($newData)-1]->Assigned_to}}">
                                                        <label class="form-check-label" for="userUpdate">
                                                            Assign complaint to {{$newData[sizeof($newData)-1]->Assigned_to}}
                                                        </label>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-warning waves-effect waves-light">Reopen</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <!-- end card body -->
            </div>

        </div><!-- /.modal-content -->
    </div>

    @endif
</div>


@endauth