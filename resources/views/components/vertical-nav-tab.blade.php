<div class="row">

    <div>
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Edit Department information</h4>
                <p class="card-title-desc">Select the Relevent</p>

                <div class="row">
                    <div class="col-md-2">


                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach($departments as $department)

                            <a class="nav-link mb-2 @if($loop->first) active @endif" id="v-pills-{{ $loop->index }}-tab" data-bs-toggle="pill" href="#v-pills-{{ $loop->index }}" role="tab" aria-controls="v-pills-{{ $loop->index }}" aria-selected="@if($loop->first) true @else false @endif">{{$department->department_name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                            @foreach($departments as $department)
                            <div class="tab-pane fade @if($loop->first) show active @endif" id="v-pills-{{ $loop->index }}" role="tabpanel" aria-labelledby="v-pills-{{ $loop->index }}-tab">
                                <p>

                                <form>
                                    @csrf
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">

                                                <h4 class="card-title">{{$department->department_name }} Details</h4>

                                                <div class="table-responsive">
                                                    <table class="table table-striped table-nowrap mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 50%;"></th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Department Head</td>
                                                                <td>
                                                                    <a href="javascript: void(0);" id="inline-username-{{ $loop->index }}" data-type="text" data-pk="{{ $loop->index }}" data-title="Enter username">{{$department->department_head }}</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Alter Head</td>
                                                                <td>
                                                                    <a href="javascript: void(0);" id="inline-firstname-{{ $loop->index }}" data-type="text" data-pk="{{ $loop->index }}" data-placement="right" data-placeholder="Required" data-title="Enter your firstname">{{$department->department_alter_head }}</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Divisions</td>
                                                                <td>
                                                                    <a href="javascript: void(0);" id="inline-sex-{{ $loop->index }}" data-type="select" data-pk="{{ $loop->index }}" data-value="" data-title="Select sex"></a>
                                                                </td>
                                                            </tr>



                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                    <button type="submit" class="btn btn-danger waves-effect waves-light" id="sa-success">Update</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>



    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <!-- Plugins js -->
    <script src="assets/libs/bootstrap-editable/js/index.js"></script>
    <script src="assets/libs/moment/min/moment.min.js"></script>
    <!-- Init js-->
    <script src="assets/js/pages/form-xeditable.init.js"></script>
    <script src="assets/js/app.js"></script>
    <!-- JAVASCRIPT -->

    <!-- Sweet Alerts js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- Sweet alert init js-->
    <script src="assets/js/pages/sweet-alerts.init.js"></script>