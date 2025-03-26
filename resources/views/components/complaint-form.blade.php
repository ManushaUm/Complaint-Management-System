@auth
@if(Session('role')=='admin')
<form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data">
    @csrf



    <div class="card px-8 mx-16">
        <div class="card-body">
            <p class="card-title-desc">Lodge new complaint</p>

            <div class="mb-3 row">
                <label for="name" class="col-md-2 col-form-label">Name<span class="text-red-500">*</span></label>
                <div class="col-md-7">
                    <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="User Name"
                        id="name" name="name">
                    @if ($errors->has('name'))
                    <span class="text-red-500 text-xs">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-2 col-form-label" id="insured">Insured?<span class="text-red-500">*</span></label>
                <div class="col-md-2">
                    <select class="form-select @error('insured') is-invalid @enderror" name="insured">
                        <option value="" selected hidden>Select...</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    @if ($errors->has('insured'))
                    <span class="text-red-500 text-xs">{{ $errors->first('insured') }}</span>
                    @endif
                </div>

                <label for="relation" class="col-md-1 col-form-label">Relation</label>
                <div class="col-md-4">
                    <input class="form-control @error('relation') is-invalid @enderror" type="text" placeholder="If No, enter the relation" id="relation" name="relation">
                </div>
                @if ($errors->has('relation'))
                <span class="text-red-500 text-xs">{{ $errors->first('relation') }}</span>
                @endif
            </div>

            <div class="mb-3 row">
                <label for="address" class="col-md-2 col-form-label">Address<span class="text-red-500">*</span></label>
                <div class="col-md-7">
                    <input class="form-control @error('address') is-invalid @enderror" type="text" value="" placeholder="Enter address"
                        id="address" name="address">
                    @if ($errors->has('address'))
                    <span class="text-red-500 text-xs">{{ $errors->first('address') }}</span>
                    @endif
                </div>
            </div>

            <div class="mb-3 row">
                <label for="contact_no" class="col-md-2 col-form-label">Contact no<span class="text-red-500">*</span></label>
                <div class="col-md-7">
                    <input class="form-control @error('contact_no') is-invalid @enderror" type="tel" placeholder="Enter contact number"
                        id="contact_no" name="contact_no">
                </div>
                @if ($errors->has('contact_no'))
                <span class="text-red-500 text-xs">{{ $errors->first('contact_no') }}</span>
                @endif
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-md-2 col-form-label">Email<span class="text-red-500">*</span></label>
                <div class="col-md-7">
                    <input class="form-control @error('email') is-invalid @enderror" type="email" value="" placeholder="Enter email"
                        id="email" name="email">
                    @if ($errors->has('email'))
                    <span class="text-red-500 text-xs">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-2 col-form-label">Complaint type<span class="text-red-500">*</span></label>
                <div class="col-md-3">
                    <select class="form-select @error('customer_type') is-invalid @enderror" name="customer_type">
                        <option value="" selected hidden>Select...</option>
                        @foreach($complaintTypes as $complaint)
                        <option value="{{$complaint->id}}">{{$complaint->complaint_type}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('customer_type'))
                    <span class="text-red-500 text-xs">{{ $errors->first('customer_type') }}</span>
                    @endif
                </div>
            </div>

            <div class="mb-3 row">
                <label for="policy-number" class="col-md-2 col-form-label">Vehicle / Policy number<span class="text-red-500">*</span></label>
                <div class="col-md-7">
                    <input class="form-control @error('policy_number') is-invalid @enderror" type="text" value="" placeholder="Enter the Insurance policy number"
                        id="policy-number" name="policy_number">
                    @if ($errors->has('policy_number'))
                    <span class="text-red-500 text-xs">{{ $errors->first('policy_number') }}</span>
                    @endif
                </div>
            </div>

            <div class="mb-3 row">
                <label for="complaint_date" class="col-md-2 col-form-label">Date of complaint<span class="text-red-500">*</span></label>
                <div class="col-md-2">
                    <input class="form-control @error('complaint_date') is-invalid @enderror" type="date"
                        id="complaint_date" name="complaint_date">
                    @if ($errors->has('complaint_date'))
                    <span class="text-red-500 text-xs">{{ $errors->first('complaint_date') }}</span>
                    @endif
                </div>
            </div>

            <div class="mb-4 row">
                <label for="complaint_detail" class="col-md-2 col-form-label">Detail of the complaint<span class="text-red-500">*</span></label>
                <div class="col-md-7">
                    <input class="form-control @error('complaint_detail') is-invalid @enderror" type="text" value="" placeholder="Enter the brief of the complaint"
                        id="complaint_detail" rows="5" name="complaint_detail">
                    @if ($errors->has('complaint_detail'))
                    <span class="text-red-500 text-xs">{{ $errors->first('complaint_detail') }}</span>
                    @endif
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-6">
                    <div class="mt-3">
                        <label for="attachment" class="form-label">Attachments</label>
                        <input class="form-control @error('attachment') is-invalid @enderror" type="file" id="attachment" name="attachment">
                    </div>
                </div>
            </div>

            <div class='col-sm-6'>
                <div>
                    <button type="submit" class="btn btn-primary w-md">Lodge</button>
                </div>
            </div>
        </div>
    </div>

</form>
@endif
@endauth