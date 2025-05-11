<!-- Department Management Interface -->
<div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Department Management</h2>
                <p class="text-blue-100 text-sm">Manage departments and divisions</p>
            </div>

            <!-- Content -->
            <div class="flex flex-col md:flex-row">
                <!-- Department Navigation -->
                <div class="md:w-1/5 bg-gray-50 p-4 border-r border-gray-200">
                    <nav>
                        <ul class="space-y-1 nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach($departments as $department)
                            <li>
                                <a class="block px-4 py-2 rounded-md text-sm font-medium transition-colors duration-150 nav-link mb-2 @if($loop->first) active bg-blue-500 text-white @else text-gray-700 hover:bg-blue-100 hover:text-blue-700 @endif"
                                    id="v-pills-{{ $loop->index }}-tab"
                                    data-bs-toggle="pill"
                                    href="#v-pills-{{ $loop->index }}"
                                    role="tab"
                                    aria-controls="v-pills-{{ $loop->index }}"
                                    aria-selected="@if($loop->first) true @else false @endif">
                                    {{$department->department_name }}
                                </a>
                            </li>
                            @endforeach
                            <li class="mt-4 pt-4 border-t border-gray-200">
                                <a class="block px-4 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-green-100 hover:text-green-700 transition-colors nav-link"
                                    id="v-pills-add-department-tab"
                                    data-bs-toggle="pill"
                                    href="#v-pills-add-department"
                                    role="tab"
                                    aria-controls="v-pills-add-department"
                                    aria-selected="false">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Add Department
                                    </span>
                                </a>
                            </li>
                            <li class="mt-1">
                                <a class="block px-4 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-green-100 hover:text-green-700 transition-colors nav-link"
                                    id="v-pills-add-division-tab"
                                    data-bs-toggle="pill"
                                    href="#v-pills-add-division"
                                    role="tab"
                                    aria-controls="v-pills-add-division"
                                    aria-selected="false">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Add Divisions
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Main Content Area -->
                <div class="md:w-4/5 p-6">
                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent" style="width:100%">
                        <!-- Department Tabs -->
                        @foreach($departments as $department)
                        <div class="tab-pane fade @if($loop->first) show active @endif" id="v-pills-{{ $loop->index}}" role="tabpanel">
                            <form>
                                @csrf
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <!-- Department Details Card -->
                                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                                        <div class="border-b border-gray-200 px-4 py-3">
                                            <h3 class="text-lg font-medium text-gray-800">{{$department->department_name }} Details</h3>
                                        </div>
                                        <div class="overflow-x-auto">
                                            <table class="w-full">
                                                <tbody class="divide-y divide-gray-200">
                                                    <tr>
                                                        <td class="px-4 py-3 bg-gray-50 text-sm font-medium text-gray-500 w-1/2">Department Head</td>
                                                        <td class="px-4 py-3 text-sm text-gray-800">
                                                            <a href="javascript:void(0);"
                                                                id="inline-username-{{ $loop->index }}"
                                                                data-type="text"
                                                                data-pk="{{ $loop->index }}"
                                                                data-title="Enter username"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#departmentDataModal"
                                                                data-department='@json($department)'
                                                                class="text-blue-600 hover:text-blue-800 hover:underline">
                                                                {{$department->department_head_name }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-4 py-3 bg-gray-50 text-sm font-medium text-gray-500">Alter Head</td>
                                                        <td class="px-4 py-3 text-sm text-gray-800">
                                                            <a href="javascript: void(0);"
                                                                id="inline-firstname-{{ $loop->index }}"
                                                                data-type="text"
                                                                data-pk="{{ $loop->index }}"
                                                                data-placement="right"
                                                                data-placeholder="Required"
                                                                data-title="Enter your firstname"
                                                                class="text-blue-600 hover:text-blue-800 hover:underline">
                                                                {{$department->department_alter_head_name }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-4 py-3 bg-gray-50 text-sm font-medium text-gray-500">Department Code</td>
                                                        <td class="px-4 py-3 text-sm text-gray-800">
                                                            <a href="javascript: void(0);"
                                                                id="inline-sex-{{ $loop->index }}"
                                                                data-type="select"
                                                                data-pk="{{ $loop->index }}"
                                                                data-value=""
                                                                data-title="Select sex"
                                                                class="text-blue-600 hover:text-blue-800 hover:underline">
                                                                {{$department -> department_code}}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Division Details Card -->
                                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                                        <div class="border-b border-gray-200 px-4 py-3">
                                            <h3 class="text-lg font-medium text-gray-800">{{$department->department_name }} Divisions</h3>
                                        </div>
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Division Name</th>
                                                        <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Division Code</th>
                                                        <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Division Head</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    @foreach ($divisionsData as $divisionData)
                                                    @if ($department->department_code == $divisionData->department_code)
                                                    <tr>
                                                        <td class="px-4 py-3 text-sm text-gray-800">
                                                            <a href="javascript:void(0);"
                                                                id="inline-username-{{ $loop->index }}"
                                                                data-type="text"
                                                                data-pk="{{ $loop->index }}"
                                                                data-title="Division_name"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#departmentDataModal"
                                                                data-department='@json($department)'
                                                                class="text-blue-600 hover:text-blue-800 hover:underline">
                                                                {{ $divisionData->division_name }}
                                                            </a>
                                                        </td>
                                                        <td class="px-4 py-3 text-sm text-gray-800">
                                                            <a href="javascript:void(0);"
                                                                id="inline-username-{{ $loop->index }}"
                                                                data-type="text"
                                                                data-pk="{{ $loop->index }}"
                                                                data-title="Division_head"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#departmentDataModal"
                                                                data-department='@json($department)'
                                                                class="text-blue-600 hover:text-blue-800 hover:underline">
                                                                {{ $divisionData->division_code }}
                                                            </a>
                                                        </td>
                                                        <td class="px-4 py-3 text-sm text-gray-800">
                                                            <a href="javascript:void(0);"
                                                                id="inline-username-{{ $loop->index }}"
                                                                data-type="text"
                                                                data-pk="{{ $loop->index }}"
                                                                data-title="Division_head"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#departmentDataModal"
                                                                data-department='@json($department)'
                                                                class="text-blue-600 hover:text-blue-800 hover:underline">
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
                            </form>
                        </div>
                        @endforeach

                        <!-- Add Department Tab -->
                        <div class="tab-pane fade" id="v-pills-add-department" role="tabpanel" aria-labelledby="v-pills-add-department-tab">
                            <div class="max-w-2xl mx-auto">
                                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                                    <div class="border-b border-gray-200 px-6 py-4">
                                        <h3 class="text-lg font-medium text-gray-800">New Department Details</h3>
                                    </div>
                                    <div class="p-6">
                                        <form class="outer-repeater needs-validation space-y-4" action="{{route('departments.store')}}" method="POST" novalidate>
                                            @csrf
                                            <div data-repeater-list="outer-group" class="outer">
                                                <div data-repeater-item class="outer">
                                                    <div class="mb-4">
                                                        <label for="deptName" class="block text-sm font-medium text-gray-700 mb-1">Department Name</label>
                                                        <input type="text" class="form-input w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" name="deptName" id="deptName" placeholder="Enter Department Name" required>
                                                        <div class="invalid-feedback text-red-500 text-sm mt-1">
                                                            Please enter a department name.
                                                        </div>
                                                    </div>

                                                    <div class="mb-4">
                                                        <label for="deptCode" class="block text-sm font-medium text-gray-700 mb-1">Department Code</label>
                                                        <input type="text" class="form-input w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" name="deptCode" id="deptCode" placeholder="Enter Department Code" required>
                                                        <div class="invalid-feedback text-red-500 text-sm mt-1">
                                                            Please enter a department code.
                                                        </div>
                                                    </div>

                                                    <div class="mb-4">
                                                        <label for="deptHead" class="block text-sm font-medium text-gray-700 mb-1">Department Head</label>
                                                        <input type="text" class="form-input w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" name="deptHead" id="deptHead" placeholder="Enter Department Head Id / Name" required>
                                                        <div class="invalid-feedback text-red-500 text-sm mt-1">
                                                            Please enter a department head ID or name.
                                                        </div>
                                                    </div>

                                                    <div class="mb-4">
                                                        <label for="deptAltHead" class="block text-sm font-medium text-gray-700 mb-1">Department Alter Head</label>
                                                        <input type="text" class="form-input w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" name="deptAltHead" id="deptAltHead" placeholder="Enter Department Alter Head Id / Name" required>
                                                        <div class="invalid-feedback text-red-500 text-sm mt-1">
                                                            Please enter a department alter head ID or name.
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                                        Submit
                                                    </button>
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

                        <!-- Add Divisions Tab -->
                        <div class="tab-pane fade" id="v-pills-add-division" role="tabpanel" aria-labelledby="v-pills-add-division-tab">
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                                <div class="border-b border-gray-200 px-6 py-4">
                                    <h3 class="text-lg font-medium text-gray-800">Add Divisions</h3>
                                </div>
                                <div class="p-6">
                                    <form class="outer-repeater needs-validation" action="{{route('division.store')}}" method="POST" novalidate>
                                        @csrf
                                        <div data-repeater-list="outer-group" class="outer">
                                            <div data-repeater-item class="outer">
                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-gray-700 mb-1" for="departmentSelect">Department</label>
                                                    <select class="form-select w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="departmentSelect" name="departmentSelect" required>
                                                        <option selected disabled value="">Choose Department</option>
                                                        @foreach($departments as $department)
                                                        <option value="{{$department->department_code}}">{{$department->department_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback text-red-500 text-sm mt-1">
                                                        Please select a department.
                                                    </div>
                                                </div>

                                                <div class="inner-repeater">
                                                    <div data-repeater-list="inner-group" class="inner">
                                                        <div data-repeater-item class="inner">
                                                            <div class="bg-gray-50 p-4 rounded-md mb-4">
                                                                <div class="flex flex-wrap -mx-2">
                                                                    <div class="w-full md:w-1/3 px-2 mb-3">
                                                                        <input type="text" class="inner form-input w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" name="divisionName" placeholder="Division Name" required />
                                                                        <div class="invalid-feedback text-red-500 text-sm mt-1">
                                                                            Please enter a division name.
                                                                        </div>
                                                                    </div>
                                                                    <div class="w-full md:w-1/3 px-2 mb-3">
                                                                        <input type="text" class="inner form-input w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" name="divisionCode" placeholder="Division Code" required />
                                                                        <div class="invalid-feedback text-red-500 text-sm mt-1">
                                                                            Please enter a division code.
                                                                        </div>
                                                                    </div>
                                                                    <div class="w-full md:w-1/3 px-2 mb-3">
                                                                        <input type="text" class="inner form-input w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" name="divisionHead" placeholder="Division Head ID" required />
                                                                        <div class="invalid-feedback text-red-500 text-sm mt-1">
                                                                            Please enter a division head ID.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="text-right">
                                                                    <input data-repeater-delete type="button" class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-medium text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-800 focus:ring focus:ring-red-300 disabled:opacity-25 transition" value="Delete" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <input data-repeater-create type="button" class="inline-flex items-center px-3 py-2 bg-green-600 border border-transparent rounded-md font-medium text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-800 focus:ring focus:ring-green-300 disabled:opacity-25 transition" value="Add Division" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                            Submit
                                        </button>
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
            </div>
        </div>

        <!-- Update Heads Card -->
        <div class="mt-8 bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-purple-800 px-6 py-4">
                <h3 class="text-lg font-medium text-white">Update Heads</h3>
            </div>
            <div class="p-6">
                <form class="outer-repeater" id="employeeSearchForm" action="{{route('departments.head')}}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="departmentSelect">Department</label>
                            <select class="form-select w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="departmentSelect" name="departmentSelect">
                                <option selected>Choose...</option>
                                @foreach($departments as $department)
                                <option value="{{$department->department_code}}">{{$department->department_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="positionSelect">Position</label>
                            <select class="form-select w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" id="positionSelect" name="positionSelect">
                                <option selected>Choose...</option>
                                <option value="deptHead">Department Head</option>
                                <option value="deptAltHead">Department Alter Head</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="empDetail">Search Employee</label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="empDetail" name="empDetail" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Search for employee">
                            </div>
                        </div>

                        <div class="flex items-end space-x-2">
                            <button type="button" id="searchEmployeeBtn" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">Search</button>
                            <input type="submit" value="Update" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-medium text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:border-yellow-800 focus:ring focus:ring-yellow-300 disabled:opacity-25 transition">
                        </div>
                    </div>
                </form>

                <!-- Employee Data Display -->
                <div class="mt-4" id="employeeData">
                    <!-- Dynamic Employee Data will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<x-department-data-modal />

<!-- Include jQuery and Bootstrap JS -->
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
<script src="assets/js/pages/sweet-alerts.init.js"></script>

<!-- Form repeater js -->
<script src="assets/libs/jquery.repeater/jquery.repeater.min.js"></script>
<script src="assets/js/pages/form-repeater.int.js"></script>

<!-- Form validation -->
<script src="assets/libs/parsleyjs/parsley.min.js"></script>
<script src="assets/js/pages/form-validation.init.js"></script>

<!-- Advanced form js -->
<script src="assets/libs/select2/js/select2.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="assets/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>
<script src="assets/js/pages/form-advanced.init.js"></script>

<!-- Tab functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the tabs if Bootstrap JS isn't properly initializing them
        const tabLinks = document.querySelectorAll('#v-pills-tab .nav-link');
        const tabPanes = document.querySelectorAll('.tab-pane');

        tabLinks.forEach(tabLink => {
            tabLink.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove active class from all tabs
                tabLinks.forEach(link => {
                    link.classList.remove('active');
                    link.classList.remove('bg-blue-500');
                    link.classList.remove('text-white');
                    link.classList.add('text-gray-700');
                    link.setAttribute('aria-selected', 'false');
                });

                // Add active class to current tab
                this.classList.add('active');
                this.classList.add('bg-blue-500');
                this.classList.add('text-white');
                this.classList.remove('text-gray-700');
                this.setAttribute('aria-selected', 'true');

                // Hide all tab panes
                tabPanes.forEach(pane => {
                    pane.classList.remove('show');
                    pane.classList.remove('active');
                });

                // Show current tab pane
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.classList.add('show');
                    target.classList.add('active');
                }
            });
        });
    });
</script>

<!-- JavaScript for the employee search functionality -->
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
                    <div class="bg-gray-50 rounded-lg border border-gray-200 p-4">
                        <h4 class="text-lg font-medium text-gray-800 mb-4">${response.full_name} Details</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-3 bg-gray-50 text-sm font-medium text-gray-500 w-1/3">Full Name</td>
                                        <td class="px-4 py-3 text-sm text-gray-800">
                                            ${response.full_name}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 bg-gray-50 text-sm font-medium text-gray-500">Employee Id</td>
                                        <td class="px-4 py-3 text-sm text-gray-800">
                                            ${response.emp_id}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 bg-gray-50 text-sm font-medium text-gray-500">Email</td>
                                        <td class="px-4 py-3 text-sm text-gray-800">
                                            ${response.email}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 bg-gray-50 text-sm font-medium text-gray-500">Phone</td>
                                        <td class="px-4 py-3 text-sm text-gray-800">
                                            ${response.phone}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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