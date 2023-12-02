    
<form action="{{route('user.profile.store')}}" enctype="multipart/form-data" method="POST">
    @csrf  
    <div class="row">
        <div class="col ">
            <div class="form-group">
                <img id="showImage" src="{{ setImage($user_details->image) }}" alt="Image" style="width:100px; height: 100px;"  >
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
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required value="{{$user_details->name}}" id="name" placeholder="Name">
                @error('name')
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
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required value="{{$user->email}}" id="email" placeholder="Email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div> 
        <div class="col">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" required name="phone" value="{{$user_details->phone}}" id="phone" placeholder="Phone">
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
                <label for="account_id">Account Id</label>
                <input type="text" class="form-control @error('account_id') is-invalid @enderror" name="account_id" value="{{$user_details->account_id}}" id="account_id" placeholder="Account Number">
                @error('account_id')
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
                <textarea name="present_address" id="" cols="5" rows="5" class="form-control">{{$user_details->present_address}}</textarea>
            </div>
        </div> 
        <div class="col">
            <div class="form-group">
                <label for="permanent address">Permanent Address</label>
                <textarea name="permanent_address" id="" cols="5" rows="5" class="form-control">{{$user_details->permanent_address}}</textarea>
            </div>
        </div>
    </div>   
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="emargency contact">Emergency Contact</label>
                <input type="tel" class="form-control" name="emergency_contact" value="{{$user_details->emergency_contact}}" id="emergency contact" placeholder="EmergencyContact">
            </div>
        </div> 
        <div class="col">
            <div class="form-group">
                <label for="occupation">Occupation</label>
                <input type="text" class="form-control" name="occupation" value="{{$user_details->occupation}}" id="occupation" placeholder="Occupation">
            </div>
        </div>
    </div>           
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="father">Father Name</label>
                <input type="text" class="form-control" name="father" value="{{$user_details->parent_name->father}}" id="father" placeholder="Father Name">
            </div>
        </div> 
        <div class="col">
            <div class="form-group">
                <label for="discount_lastdate">Mother Name</label>
                <input type="text" class="form-control" name="mother" value="{{$user_details->parent_name->mother}}" id="mother" placeholder="Mother Name">
            </div>
        </div>
    </div>
    <div>
        <h4 class="text-info font-weight-bold"> Update Password</h4>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="discount_lastdate">Password</label>
                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="discount_lastdate">Confirm Password</label>
                <input type="confirmpassword" class="form-control form-control-user @error('confirm-password') is-invalid @enderror" id="confirm-password" name="confirm-password" placeholder="Confirm Password">
                @error('confirm-password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block" role="button"> Save</button>
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
