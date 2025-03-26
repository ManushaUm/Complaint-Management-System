@auth
@if(Session('role')=='admin')
<div class="container mx-auto px-4 py-4">
    <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-lg rounded-lg p-6">
        @csrf
        <h2 class="text-xl font-bold text-gray-800 mb-4 text-center">Lodge New Complaint</h2>

        <div class="grid grid-cols-2 gap-4">
            {{-- Name Field --}}
            <div class="col-span-2">
                <label for="name" class="block text-xs font-medium text-gray-700 mb-1">
                    Name <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Enter your full name"
                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 
                    @error('name') border-red-500 @enderror">
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Insured and Relation --}}
            <div>
                <label for="insured" class="block text-xs font-medium text-gray-700 mb-1">
                    Insured? <span class="text-red-500">*</span>
                </label>
                <select
                    name="insured"
                    id="insured"
                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500
                    @error('insured') border-red-500 @enderror">
                    <option value="" selected hidden>Select...</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
                @error('insured')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="relation" class="block text-xs font-medium text-gray-700 mb-1">
                    Relation (if not insured)
                </label>
                <input
                    type="text"
                    id="relation"
                    name="relation"
                    placeholder="Enter relation"
                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500
                    @error('relation') border-red-500 @enderror">
                @error('relation')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Contact and Email --}}
            <div>
                <label for="contact_no" class="block text-xs font-medium text-gray-700 mb-1">
                    Contact Number <span class="text-red-500">*</span>
                </label>
                <input
                    type="tel"
                    id="contact_no"
                    name="contact_no"
                    placeholder="Enter contact number"
                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500
                    @error('contact_no') border-red-500 @enderror">
                @error('contact_no')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-xs font-medium text-gray-700 mb-1">
                    Email <span class="text-red-500">*</span>
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter email address"
                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500
                    @error('email') border-red-500 @enderror">
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Address Field --}}
            <div class="col-span-2">
                <label for="address" class="block text-xs font-medium text-gray-700 mb-1">
                    Address <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="address"
                    name="address"
                    placeholder="Enter full address"
                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500
                    @error('address') border-red-500 @enderror">
                @error('address')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Complaint Type --}}
            <div>
                <label for="customer_type" class="block text-xs font-medium text-gray-700 mb-1">
                    Complaint Type <span class="text-red-500">*</span>
                </label>
                <select
                    name="customer_type"
                    id="customer_type"
                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500
                    @error('customer_type') border-red-500 @enderror">
                    <option value="" selected hidden>Select Type...</option>
                    @foreach($complaintTypes as $complaint)
                    <option value="{{$complaint->id}}">{{$complaint->complaint_type}}</option>
                    @endforeach
                </select>
                @error('customer_type')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Policy Number --}}
            <div>
                <label for="policy_number" class="block text-xs font-medium text-gray-700 mb-1">
                    Policy Number <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="policy_number"
                    name="policy_number"
                    placeholder="Enter policy number"
                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500
                    @error('policy_number') border-red-500 @enderror">
                @error('policy_number')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Complaint Date --}}
            <div>
                <label for="complaint_date" class="block text-xs font-medium text-gray-700 mb-1">
                    Date of Complaint <span class="text-red-500">*</span>
                </label>
                <input
                    type="date"
                    id="complaint_date"
                    name="complaint_date"
                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500
                    @error('complaint_date') border-red-500 @enderror">
                @error('complaint_date')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Complaint Details --}}
            <div class="col-span-2">
                <label for="complaint_detail" class="block text-xs font-medium text-gray-700 mb-1">
                    Complaint Details <span class="text-red-500">*</span>
                </label>
                <textarea
                    id="complaint_detail"
                    name="complaint_detail"
                    rows="3"
                    placeholder="Enter complaint details"
                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500
                    @error('complaint_detail') border-red-500 @enderror"></textarea>
                @error('complaint_detail')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Attachments --}}
            <div class="col-span-2">
                <label for="attachment" class="block text-xs font-medium text-gray-700 mb-1">
                    Attachments
                </label>
                <input
                    type="file"
                    id="attachment"
                    name="attachment"
                    class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500
                    file:mr-2 file:px-2 file:py-1 file:text-xs file:rounded-md file:border-0 file:bg-blue-500 file:text-white
                    @error('attachment') border-red-500 @enderror">
                @error('attachment')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="col-span-2 mt-2">
                <button
                    type="submit"
                    class="w-full bg-blue-500 text-white py-2 text-sm rounded-md hover:bg-blue-600 transition duration-300 ease-in-out focus:outline-none focus:ring-1 focus:ring-blue-500">
                    Lodge Complaint
                </button>
            </div>
        </div>
    </form>
</div>
@endif
@endauth