<!--Department/Division heads Assigned Table -->
<div class="tab-pane" id="assigned-complaints" role="tabpanel">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @if(count($assignedComplaints) > 0)
                <x-complaint-view-table :complaints="$assignedComplaints" :departmentNames="$departmentNames" :divisionNames="$divisionNames" />
                @else

                <div class="my-2 p-4 bg-yellow-100 text-yellow-700 rounded-md">
                    <p class="font-medium"><span><i class="bx bx-info-circle"></i></span> There are no assigned complaints left.</p>
                </div>

                @endif
            </div>
        </div>
    </div>
</div>