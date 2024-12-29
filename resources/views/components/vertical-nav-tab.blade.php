<div class="row">

    <div>
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Edit Department information</h4>
                <p class="card-title-desc">Select the Relevant</p>

                <div class="row">
                    <div class="col-md-2">

                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach($departments as $department)

                            <a class="nav-link mb-2 @if($loop->first) active @endif" id="v-pills-{{ $loop->index }}-tab" data-bs-toggle="pill" href="#v-pills-{{ $loop->index }}" role="tab" aria-controls="v-pills-{{ $loop->index }}" aria-selected="@if($loop->first) true @else false @endif">{{$department->department_name }}</a>
                            @endforeach
                            <a class="nav-link" id="v-pills-add-department-tab" data-bs-toggle="pill" href="#v-pills-add-department" role="tab" aria-controls="v-pills-add-department" aria-selected="false">Add Department</a>

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
                                                                    <a href="javascript:void(0);" id="inline-username-{{ $loop->index }}" data-type="text" data-pk="{{ $loop->index }}" data-title="Enter username" data-bs-toggle="modal" data-bs-target="#departmentDataModal" data-department='@json($department)'>{{$department->department_head }}</a>
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
                            <!--Add department-->
                            <div class="tab-pane fade" id="v-pills-add-department" role="tabpanel" aria-labelledby="v-pills-add-department-tab">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">Add new Department</h4>
                                                <form class="outer-repeater" action="{{route('departments.store')}}" method="POST">
                                                    @csrf
                                                    <div data-repeater-list="outer-group" class="outer">
                                                        <div data-repeater-item class="outer">
                                                            <div class="mb-3">
                                                                <label for="deptName">Department Name</label>
                                                                <input type="text" class="form-control" name="deptName" id="deptName"
                                                                    placeholder="Enter Department Name">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="deptCode">Department Code</label>
                                                                <input type="text" class="form-control" name="deptCode" id="deptCode"
                                                                    placeholder="Enter Department Code">
                                                            </div>



                                                            <div class="mb-3">
                                                                <label for="deptHead">Department Head</label>
                                                                <input type="text" class="form-control" name="deptHead" id="deptHead"
                                                                    placeholder="Enter Department Head Id / Name">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="deptAltHead">Department Alter Head</label>
                                                                <input type="text" class="form-control" name="deptAltHead" id="deptAltHead"
                                                                    placeholder="Enter Department Head Id / Name">
                                                            </div>

                                                            <div class="inner-repeater mb-4">
                                                                <div data-repeater-list="inner-group" class="inner mb-3">
                                                                    <label>Sub Divisions :</label>
                                                                    <div data-repeater-item class="inner mb-3 row">
                                                                        <div class="col-md-10 col-8">
                                                                            <input type="text" class="inner form-control" name=""
                                                                                placeholder="Divisions of the department" />
                                                                        </div>
                                                                        <div class="col-md-2 col-4">
                                                                            <div class="d-grid">
                                                                                <input data-repeater-delete type="button"
                                                                                    class="btn btn-warning inner" value="Delete" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <input data-repeater-create type="button"
                                                                    class="btn btn-success inner" value="Add Division" />
                                                            </div>




                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end card -->
        </div>
        <x-department-data-modal />

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

    <!-- form repeater js -->
    <script src="assets/libs/jquery.repeater/jquery.repeater.min.js"></script>

    <script src="assets/js/pages/form-repeater.int.js"></script>

    <script src="assets/js/app.js"></script>