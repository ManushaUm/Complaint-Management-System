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
                                    <span class="d-none d-sm-block">New log</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#prevAssign" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">Previous assignment</span>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="newLog" role="tabpanel">
                                <form action="{{route('logcomplaint' , ['id' => $id])}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class=" mb-3">
                                        <label for="headNote" class="col-form-label">Notes</label>
                                        <textarea class="form-control my-2" id="headNote" name="headNote"></textarea>

                                        <input class="form-control form-control-sm" id="formFileSm" type="file">
                                    </div>
                                </form>

                            </div>
                            <div class="tab-pane" id="prevAssign" role="tabpanel">
                                <form action="{{route('logcomplaint' , ['id' => $id , 'dataRecord' => $newData[sizeof($newData)-1]])}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class=" mb-3">
                                        <label for="headNote" class="col-form-label">Notes</label>
                                        <textarea class="form-control my-2" id="headNote" name="headNote"></textarea>

                                        <input class="form-control form-control-sm" id="formFileSm" type="file">
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