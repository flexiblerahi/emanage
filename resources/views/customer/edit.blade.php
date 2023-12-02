@include('modules.backbutton', ['previous' => route('customer.index')])
<form action="{{route('customer.update', $customer->id)}}" enctype="multipart/form-data" method="post">
    @csrf
    @method('put') 
    <div class="row">
        <div class="col ">
            <div class="form-group">
                <img id="showImage" src="{{ setImage($customer->image) }}" alt="Image" style="width:100px; height: 100px;"  >
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="image">Image</label>
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
                <input type="text" class="form-control" id="account_id" name="account_id" value="{{ $customer->accounted_id }}" placeholder="Account Number">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $customer->name }}" required autocomplete="name" autofocus>
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
                <input type="tel" class="form-control @error('phone') is-invalid @enderror"value="{{ $customer->phone }}" name="phone" id="phone" placeholder="Phone">
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
                <textarea name="present_address" id="" cols="5" rows="5" class="form-control">{{ $customer->present_address }}</textarea>
            </div>
        </div> 
        <div class="col">
            <div class="form-group">
                <label for="permanent address">Permanent Address</label>
                <textarea name="permanent_address" id="" cols="5" rows="5" class="form-control">{{ $customer->permanent_address }}</textarea>
            </div>
        </div>
    </div>   
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="emargency contact">Emergency Contact</label>
                <input type="tel" class="form-control" name="emergency_contact" value="{{ $customer->emergency_contact }}" id="emergency contact" placeholder="EmergencyContact">
            </div>
        </div> 
        <div class="col">
            <div class="form-group">
                <label for="occupation">Occupation</label>
                <input type="text" class="form-control" name="occupation" value="{{ $customer->occupation }}" id="occupation" placeholder="Occupation">
            </div>
        </div>
    </div>           
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="father">Father Name</label>
                <input type="text" class="form-control" name="father" value="{{$customer->parent_name->father}}" id="father" placeholder="Father Name">
            </div>
        </div> 
        <div class="col">
            <div class="form-group">
                <label for="discount_lastdate">Mother Name</label>
                <input type="text" class="form-control" name="mother" value="{{$customer->parent_name->mother}}" id="mother" placeholder="Mother Name">
            </div>
        </div>
    </div>
    @include('modules.checkbox', ['status' => $customer->status])
    <button type="submit" class="btn btn-primary btn-block" role="button"> Update</button>
</form>
<script>
    function readupdateprofileimgURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#showImage')
                      .attr('src', e.target.result);
              };
              reader.readAsDataURL(input.files[0]);
          }
      }
</script>
