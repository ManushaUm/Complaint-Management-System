<div class="row" style="margin: 10px;">

    <div class="col-md-8">
        <!-- First column content here -->
        <div class="col-12">
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
                                <a class="nav-link" id="v-pills-add-division-tab" data-bs-toggle="pill" href="#v-pills-add-division" role="tab" aria-controls="v-pills-add-division" aria-selected="false">Add Divisions</a>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                @foreach($departments as $department)

                                <div class="tab-pane fade @if($loop->first) show active @endif" id="v-pills-{{ $loop->index}}" role="tabpanel">


                                    <form>
                                        @csrf
                                        <div class="row">
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
                                                                            <a href="javascript:void(0);" id="inline-username-{{ $loop->index }}" data-type="text" data-pk="{{ $loop->index }}" data-title="Enter username" data-bs-toggle="modal" data-bs-target="#departmentDataModal" data-department='@json($department)'>{{$department->department_head_name }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Alter Head</td>
                                                                        <td>
                                                                            <a href="javascript: void(0);" id="inline-firstname-{{ $loop->index }}" data-type="text" data-pk="{{ $loop->index }}" data-placement="right" data-placeholder="Required" data-title="Enter your firstname">{{$department->department_alter_head_name }}</a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Department Code</td>
                                                                        <td>
                                                                            <a href="javascript: void(0);" id="inline-sex-{{ $loop->index }}" data-type="select" data-pk="{{ $loop->index }}" data-value="" data-title="Select sex">{{$department -> department_code}}</a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Divisions start -->



                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-body">

                                                        <h4 class="card-title">{{$department->department_name }} Divisions</h4>
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-nowrap mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 50%;">Division Name</th>
                                                                        <th>Division Code</th>
                                                                        <th>Division Head</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    @foreach ($divisionsData as $divisionData)
                                                                    @if ($department->department_code == $divisionData->department_code)
                                                                    <tr>
                                                                        <td><a href="javascript:void(0);" id="inline-username-{{ $loop->index }}"
                                                                                data-type="text"
                                                                                data-pk="{{ $loop->index }}"
                                                                                data-title="Division_name"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#departmentDataModal"
                                                                                data-department='@json($department)'>
                                                                                {{ $divisionData->division_name }}
                                                                            </a></td>

                                                                        <td>
                                                                            <a href="javascript:void(0);" id="inline-username-{{ $loop->index }}"
                                                                                data-type="text"
                                                                                data-pk="{{ $loop->index }}"
                                                                                data-title="Division_head"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#departmentDataModal"
                                                                                data-department='@json($department)'>
                                                                                {{ $divisionData->division_code }}
                                                                            </a>
                                                                        </td>

                                                                        <td>
                                                                            <a href="javascript:void(0);" id="inline-username-{{ $loop->index }}"
                                                                                data-type="text"
                                                                                data-pk="{{ $loop->index }}"
                                                                                data-title="Division_head"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#departmentDataModal"
                                                                                data-department='@json($department)'>
                                                                                {{ $divisionData->div_head_name }}
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                                    @endforeach


                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->

                                    </form>

                                    <!-- Edit information -->

                                </div>
                                <!--Add department-->
                                <div class="tab-pane fade" id="v-pills-add-department" role="tabpanel" aria-labelledby="v-pills-add-department-tab" style="margin-left: 160px;">

                                    <div>
                                        <div class="col-lg-10">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-4">New Department Details</h4>
                                                    <form class="outer-repeater needs-validation" action="{{route('departments.store')}}" method="POST" novalidate>
                                                        @csrf
                                                        <div data-repeater-list="outer-group" class="outer">
                                                            <div data-repeater-item class="outer">
                                                                <div class="mb-3">
                                                                    <label for="deptName">Department Name</label>
                                                                    <input type="text" class="form-control" name="deptName" id="deptName"
                                                                        placeholder="Enter Department Name" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a department name.
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="deptCode">Department Code</label>
                                                                    <input type="text" class="form-control" name="deptCode" id="deptCode"
                                                                        placeholder="Enter Department Code" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a department code.
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="deptHead">Department Head</label>
                                                                    <input type="text" class="form-control" name="deptHead" id="deptHead"
                                                                        placeholder="Enter Department Head Id / Name" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a department head ID or name.
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="deptAltHead">Department Alter Head</label>
                                                                    <input type="text" class="form-control" name="deptAltHead" id="deptAltHead"
                                                                        placeholder="Enter Department Alter Head Id / Name" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a department alter head ID or name.
                                                                    </div>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    <script>
                                                        (function() {
                                                            'use strict';
                                                            window.addEventListener('load', function() {
                                                                var forms = document.getElementsByClassName('needs-validation');
                                                                Array.prototype.filter.call(forms, function(form) {
                                                                    form.addEventListener('submit', function(event) {
                                                                        if (form.checkValidity() === false) {
                                                                            event.preventDefault();
                                                                            event.stopPropagation();
                                                                        }
                                                                        form.classList.add('was-validated');
                                                                    }, false);
                                                                });
                                                            }, false);
                                                        })();
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!--Add divisions-->
                                <div class="tab-pane fade" id="v-pills-add-division" role="tabpanel" aria-labelledby="v-pills-add-division-tab">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-4">Add Divisions</h4>
                                                    <form class="outer-repeater needs-validation" action="{{route('division.store')}}" method="POST" novalidate>
                                                        @csrf
                                                        <div data-repeater-list="outer-group" class="outer">
                                                            <div data-repeater-item class="row outer" style="margin: 10px">
                                                                <div class="col-md-5">
                                                                    <div class="mb-3">
                                                                        <label class="visually-hidden" for="departmentSelect">Preference</label>

                                                                        <select class="form-select" id="departmentSelect" name="departmentSelect" required>
                                                                            <option selected disabled value="">Choose Department</option>
                                                                            @foreach($departments as $department)
                                                                            <option value="{{$department->department_code}}">{{$department->department_name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <div class="invalid-feedback">
                                                                            Please select a department.
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!--Division adding part-->


                                                                <div class="inner-repeater mb-4">
                                                                    <div data-repeater-list="inner-group" class="inner mb-3">
                                                                        <div data-repeater-item class="inner mb-3 row">
                                                                            <div class="col-md-3 col-4">
                                                                                <input type="text" class="inner form-control" name="divisionName" placeholder="Division Name" required />
                                                                                <div class="invalid-feedback">
                                                                                    Please enter a division name.
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-3 col-4">
                                                                                <input type="text" class="inner form-control" name="divisionCode" placeholder="Division Code" required />
                                                                                <div class="invalid-feedback">
                                                                                    Please enter a division code.
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3 col-4">
                                                                                <input type="text" class="inner form-control" name="divisionHead" placeholder="Division Head ID" required />
                                                                                <div class="invalid-feedback">
                                                                                    Please enter a division head ID.
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-2 col-4">
                                                                                <div class="d-grid">
                                                                                    <input data-repeater-delete type="button" class="btn btn-warning inner" value="Delete" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input data-repeater-create type="button" class="btn btn-success inner" value="Add Division" />

                                                                </div>
                                                            </div>

                                                        </div>


                                                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                                                    </form>

                                                    <script>
                                                        (function() {
                                                            'use strict';
                                                            window.addEventListener('load', function() {
                                                                var forms = document.getElementsByClassName('needs-validation');
                                                                Array.prototype.filter.call(forms, function(form) {
                                                                    form.addEventListener('submit', function(event) {
                                                                        if (form.checkValidity() === false) {
                                                                            event.preventDefault();
                                                                            event.stopPropagation();
                                                                        }
                                                                        form.classList.add('was-validated');
                                                                    }, false);
                                                                });
                                                            }, false);
                                                        })();
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @endforeach
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <!-- end card -->
        </div>
    </div>

    <div class="col-md-4">
        <!-- Second column -->

        <div class="col-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <h5 class="card-title mb-4">Update Heads</h5>

                            <form class="row row-cols-lg-auto g-3 align-items-center" id="employeeSearchForm" action="{{route('departments.head')}}" method="POST">
                                @csrf
                                <div class="col-4">
                                    <label class="visually-hidden" for="departmentSelect">Preference</label>
                                    <select class="form-select" id="departmentSelect" name="departmentSelect">
                                        <option selected>Choose...</option>
                                        @foreach($departments as $department)
                                        <option value="{{$department->department_code}}">{{$department->department_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label class="visually-hidden" for="positionSelect">Preference</label>
                                    <select class="form-select" id="positionSelect" name="positionSelect">
                                        <option selected>Choose...</option>
                                        <option value="deptHead">Department Head</option>
                                        <option value="deptAltHead">Department Alter Head</option>
                                    </select>
                                </div>


                                <div class="col-6">
                                    <label class="visually-hidden" for="empDetail">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="fas fa-search"></i></div>
                                        <input type="text" class="form-control" id="empDetail" name="empDetail" placeholder="Search for employee">
                                    </div>
                                </div>


                                <div class="col-6">
                                    <button type="button" id="searchEmployeeBtn" class="btn btn-danger w-md">Search Employee</button>
                                    <input class="btn btn-warning" type="submit" value="Update">
                                </div>
                            </form>
                            <!-- Employee Data Display -->
                            <div class="mt-4" id="employeeData">
                                <!-- Dynamic Employee Data will be loaded here -->
                            </div>


                        </div>

                        <!-- end card body -->
                    </div>

                    <!-- end card -->

                </div>

                <!-- end col -->

            </div>
        </div>


    </div>
</div>


</div>

<x-department-data-modal />



<script>
    $(document).ready(function() {
        $('#searchEmployeeBtn').on('click', function(e) {
            e.preventDefault();
            const empDetail = $('#empDetail').val();

            if (!empDetail) {
                alert('Please enter employee details');
                return;
            }

            $.ajax({
                url: '/employee/search',
                type: 'GET',
                data: {
                    empDetail: empDetail
                },
                success: function(response) {
                    $('#employeeData').html(`
    <div class="card-body">
        <h4 class="card-title">${response.full_name} Details</h4>
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
                        <td>Full Name</td>
                        <td>
                            <a href="javascript:void(0);" id="emp_name">${response.full_name}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Employee Id</td>
                        <td>
                            <a href="javascript: void(0);" id="emp_id">${response.emp_id}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <a href="javascript: void(0);" id="emp_email">${response.email}</a>
                        </td>
                    </tr>

                    <tr>
                        <td>Phone</td>
                        <td>
                            <a href="javascript: void(0);" id="emp_email">${response.phone}</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="margin: 10px">
           
        </div>
    </div>
    `);
                },
                error: function(error) {
                    alert('Employee not found');
                }
            });
        });
    });
</script>



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

<!-- Sweet Alerts js -->
<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
<!-- Sweet alert init js-->
<script src="assets/js/pages/sweet-alerts.init.js"></script>

<!-- form repeater js -->
<script src="assets/libs/jquery.repeater/jquery.repeater.min.js"></script>

<script src="assets/js/pages/form-repeater.int.js"></script>

<script src="assets/js/app.js"></script>

<script src="assets/libs/parsleyjs/parsley.min.js"></script>
<script src="assets/js/pages/form-validation.init.js"></script>

<script src="assets/libs/select2/js/select2.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="assets/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>

<!-- form advanced init -->
<script src="assets/js/pages/form-advanced.init.js"></script>