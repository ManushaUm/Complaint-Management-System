<div>
    @auth
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle table-nowrap mb-0">
                    <thead class="bg-slate-700 text-slate-200">
                        <tr>
                            <th>Customer</th>
                            <th>Contact No</th>

                            <th>Customer Type</th>
                            <th>Policy/Vehicle Number</th>
                            <th>Complaint Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($complaints as $complaint)

                        @php
                        $tableclass = $complaint->priority == 'high' ? 'table-danger' : 'table-light';
                        @endphp
                        <tr class="{{$tableclass}}">
                            <td>{{ $complaint->name }}</td>
                            <td>{{ $complaint->contact_no }}</td>
                            <td>{{ $complaint->customer_type }}</td>
                            <td>{{ $complaint->policy_number }}</td>
                            <td>{{ $complaint->complaint_date }}</td>

                            <td>
                                <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                                    data-bs-toggle="modal"
                                    data-bs-target="#transaction-detailModal"
                                    data-complaint='@json($complaint)'>
                                    View Details
                                </button>

                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>

            </div>
            <!-- Assigning Modal -->
            <x-complaint-assign-modal :departmentNames="$departmentNames" :divisionNames="$divisionNames" />
            <!-- end modal -->

            <!-- end table -->
        </div>
    </div>
    @endauth
</div>