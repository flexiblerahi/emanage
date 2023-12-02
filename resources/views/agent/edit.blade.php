@include('modules.backbutton', ['previous' => route('agent.index')])

<form action="{{route('agent.update', $agent->id)}}" enctype="multipart/form-data" method="post">
    @csrf
    @method('put') 
    <div class="row mb-3">
        <div class="col">
            <fieldset class="border p-2">
                <legend class="float-none w-auto ">Referene Id</legend>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input type="hidden" id='reference_id' value="{{ $agentId[0] }}" name="reference_id">
                            <input type="text" class="form-control" id="user_details_phone" data-user="agent" value="{{ $sh_agent->phone }}" list="user_details_list" placeholder="Search by agent or share holder phone number or Account id">
                            <datalist id="user_details_list">
                            </datalist>
                        </div>
                    </div>
                </div>
                <div id="referenceDetails">
                    @include('agent.referenceDetails', ['user_detail' => $sh_agent])
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="col ">
            <div class="form-group">
                <img id="showImage" src="{{ setImage($agent->image) }}" alt="Image" style="width:100px; height: 100px;"  >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="mother">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" onchange="readupdateprofileimgURL(this);" placeholder="Image">
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="account_id">Account Id</label>
                <input type="text" class="form-control" id="account_id" name="account_id" value="{{ $agent->account_id }}" placeholder="Account Number">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $agent->name }}" required autocomplete="name" autofocus>
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
                <input type="tel" class="form-control @error('phone') is-invalid @enderror"value="{{ $agent->phone }}" name="phone" id="phone" placeholder="Phone">
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
                <textarea name="present_address" id="" cols="5" rows="5" class="form-control">{{ $agent->present_address }}</textarea>
            </div>
        </div> 
        <div class="col">
            <div class="form-group">
                <label for="permanent address">Permanent Address</label>
                <textarea name="permanent_address" id="" cols="5" rows="5" class="form-control">{{ $agent->permanent_address }}</textarea>
            </div>
        </div>
    </div>   
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="emargency contact">Emergency Contact</label>
                <input type="tel" class="form-control" name="emergency_contact" value="{{ $agent->emergency_contact }}" id="emergency contact" placeholder="EmergencyContact">
            </div>
        </div> 
        <div class="col">
            <div class="form-group">
                <label for="occupation">Occupation</label>
                <input type="text" class="form-control" name="occupation" value="{{ $agent->occupation }}" id="occupation" placeholder="Occupation">
            </div>
        </div>
    </div>           
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="father">Father Name</label>
                <input type="text" class="form-control" name="father" value="{{$agent->parent_name->father}}" id="father" placeholder="Father Name">
            </div>
        </div> 
        <div class="col">
            <div class="form-group">
                <label for="discount_lastdate">Mother Name</label>
                <input type="text" class="form-control" name="mother" value="{{$agent->parent_name->mother}}" id="mother" placeholder="Mother Name">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="control-label">{{trans('Status')}}</div>
        <label class="custom-switch pl-0 mt-2">
            <input type="checkbox" name="status" class="custom-switch-input" @if ($agent->status == 1) checked @endif>
            <span class="custom-switch-indicator"></span>
            <span class="custom-switch-description">{{trans('OFF')}} /
                {{trans('ON')}}</span>
        </label>
    </div>
    <button type="submit" class="btn btn-primary btn-block" role="button"> Update</button>
</form>
@push('script')
    <script src="{{url('js/userdetail.js')}}"></script>
@endpush