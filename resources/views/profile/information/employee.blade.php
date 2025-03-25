<x-app-layout>
    <x-slot name="slot">
        <div class="page-content">
        <div class="profile-section" style="background:  rgb(184, 167, 167); padding: 20px; border-radius: 6px; display: flex; flex-direction: column; align-items: flex-start; max-width: 100%; margin: auto;">
            <!-- Profile Image & Name -->
            <div style="display: flex; align-items: center; gap: 15px;">
                <!-- Avatar -->
                <div style="width: 120px; height: 120px; border-radius: 50%; background-color: #ccc; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/users/avatar-1.jpg') }}" >
                </div>

                <!-- Name -->
                <h2 style="margin: 0; color: #333; font-size: 22px;">{{ $user->name }}</h2>
            </div>

            <!-- Details Containers -->
            <div style="display: flex; flex-wrap: wrap; gap: 20px; width: 100%; margin-top: 15px;">
                
                <!-- First Box: Department, ID, Role -->
                <div style="background: white; padding: 15px; border-radius: 4px; box-shadow: 0px 2px 5px rgba(0,0,0,0.1); flex: 1; min-width: 250px;">
                    <p style="color: #666; font-size: 16px; margin-bottom: 8px;"><strong>Role:</strong> {{ $user->role }}</p>
                    <p style="color: #666; font-size: 16px; margin-bottom: 8px;"><strong>Department:</strong> {{ $user->department ?? 'Not assigned' }}</p>
                    <p style="color: #666; font-size: 16px;"><strong>ID:</strong> {{ $user->emp_id }}</p>
                </div>

                <!-- Second Box: Employee ID and Email -->
                <div style="background: white; padding: 15px; border-radius: 4px; box-shadow: 0px 2px 5px rgba(0,0,0,0.1); flex: 1; min-width: 250px;">
                    <p style="color: #666; font-size: 16px; margin-bottom: 8px;">
                        <i class="fas fa-id-badge" style="margin-right: 5px;"></i> {{ $user->emp_id }}
                    </p>
                    <p style="color: #666; font-size: 16px;">
                        <i class="fas fa-envelope" style="margin-right: 5px;"></i> {{ $user->email }}
                    </p>
                </div>

            </div>
        </div>
        <div class="container-fluid page-content">
            <div class="row">
                <div class="col-12">
                    <h1 class="mb-4">Assigned Complaints</h1>
                    <div class="row">
                        @if(isset($complaints) && count($complaints) > 0)
                            @foreach ($complaints as $complaint)
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $complaint->name }}</h5>
                                            <p><strong>ID:</strong> {{ $complaint->id }}</p>
                                            <p><strong>Policy Number:</strong> {{ $complaint->policy_number }}</p>
                                            <p><strong>Complaint:</strong> 
                                                {{ Str::limit($complaint->complaint_detail, 100, '...') }}
                                            </p>
                                            
                                            <button type="button" class="btn btn-primary btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target="#transaction-detailModal"data-complaint='@json($complaint)'>
                                                View Details
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <p>No complaints found.</p>
                            </div>
                        @endif    
                    </div>
                </div>
            </div>
        </div>
        <x-complaint-assign-modal :departmentNames="$departmentNames" :divisionNames="$divisionNames" />

        </div>
    </div>
    </x-slot>
</x-app-layout>
