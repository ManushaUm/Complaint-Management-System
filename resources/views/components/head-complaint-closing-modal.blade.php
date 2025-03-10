<div id="complaintAction" class="modal fade" tabindex="-1" aria-labelledby="complaintActionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="complaintActionLabel"><span class="card-title">Complaint Closing</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <form action="{{route('closeComplaint' , ['id' => $id])}}" method="POST">
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

                        <input class="form-control form-control-sm" id="formFileSm" type="file">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Close Job</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>