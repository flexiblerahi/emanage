@include('modules.backbutton')
<form action="{{route('employee.update', $employee->id)}}" enctype="multipart/form-data" method="post">
    @csrf
    @method('put') 
    <div class="row">
        <div class="col">
            <div class="form-group">
                <img id="showImage" src="{{ setImage($employee->image) }}" alt="Image" style="width:100px; height: 100px;"  >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="mother">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" onchange="readupdateprofileimgURL(this);" placeholder="Image">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="account_id">Account Id</label>
                <input type="text" class="form-control" id="account_id" name="account_id" value="{{ $employee->account_id }}" placeholder="Account Number">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $employee->name }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control @error('phone') is-invalid @enderror"value="{{ $employee->phone }}" name="phone" id="phone" placeholder="Phone">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="present address">Present Address</label>
                <textarea name="present_address" id="" cols="5" rows="5" class="form-control">{{ $employee->present_address }}</textarea>
            </div>
        </div> 
        <div class="col">
            <div class="form-group">
                <label for="permanent address">Permanent Address</label>
                <textarea name="permanent_address" id="" cols="5" rows="5" class="form-control">{{ $employee->permanent_address }}</textarea>
            </div>
        </div>
    </div>   
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="emargency contact">Emergency Contact</label>
                <input type="tel" class="form-control" name="emergency_contact" value="{{ $employee->emergency_contact }}" id="emergency contact" placeholder="EmergencyContact">
            </div>
        </div> 
        <div class="col">
            <div class="form-group">
                <label for="occupation">Designation</label>
                <input type="text" class="form-control" name="occupation" value="{{ $employee->occupation }}" id="occupation" placeholder="Designation">
            </div>
        </div>
    </div>           
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="father">Father Name</label>
                <input type="text" class="form-control" name="father" value="{{$employee->parent_name->father}}" id="father" placeholder="Father Name">
            </div>
        </div> 
        <div class="col">
            <div class="form-group">
                <label for="discount_lastdate">Mother Name</label>
                <input type="text" class="form-control" name="mother" value="{{$employee->parent_name->mother}}" id="mother" placeholder="Mother Name">
            </div>
        </div>
    </div>
    @include('modules.checkbox', ['status' => $employee->status])
    <button type="submit" class="btn btn-primary btn-block" role="button"> Save</button>
</form>
@push('script')
    <script src="{{url('js/userdetail.js')}}"></script>
@endpush