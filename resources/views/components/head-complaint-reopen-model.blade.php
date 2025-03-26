<div id="complaintOpen" class="modal fade" tabindex="-1" aria-labelledby="complaintOpenLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="complaintOpenLabel"><span class="card-title">Complaint Re-open</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

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

                <!--Tab Planes-->
                <div class="card">
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#newLog" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Action</span>
                                </a>
                            </li>

                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="newLog" role="tabpanel">
                                <form action="{{route('logcomplaint' , ['id' => $id])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class=" mb-3">
                                        <label for="headNote" class="col-form-label">Notes <span class="text-red-500">*</span></label>
                                        <textarea class="form-control" id="headNote" name="headNote"></textarea>

                                        <label for="formrow-inputState" class="form-label mt-2">Priority <span class="text-red-500">*</span></label>

                                        <select id="priority" name="priority" class="form-select">
                                            <option selected>Select...</option>
                                            <option value="high">high</option>
                                            <option value="medium">medium</option>
                                            <option value="low">low</option>
                                        </select>

                                        <input class="form-control form-control-sm my-3" name="formFileSm" id="formFileSm" type="file">

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="userAssignment" name="userAssignment" value="{{$newData[sizeof($newData)-1]->Assigned_to}}">
                                            <label class="form-check-label" for="userAssignment">
                                                Assign job to <span class="text-blue-500">{{$newData[sizeof($newData)-1]->Assigned_to}}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success waves-effect waves-light">Log complaint</button>
                                </form>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>

            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>