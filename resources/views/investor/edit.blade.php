<div class="row">
  <div class="col text-right">
      <a class="btn btn-primary " href="{{ URL::previous() }}" role="button"><i
          class="fas fa-arrow-circle-left"></i> Back</a>
  </div>
</div>              
<form action="{{route('investor.update', $investor->id)}}" enctype="multipart/form-data" method="POST">
  @csrf  
  @method('put')
  <div class="row">
      <div class="col ">
          <div class="form-group">
              <img id="showImage" src="{{ setImage($investor->image) }}" alt="Image" style="width:100px; height: 100px;"  >
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col">
          <div class="form-group">
              <label for="mother">Image</label>
              <input type="file" class="form-control" value="{{setImage($investor->image)}}" name="image" id="image" onchange="readupdateprofileimgURL(this);" placeholder="Image">
          </div>
      </div>
  </div>
  
  <div class="row">
      <div class="col">
          <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $investor->name }}" required autocomplete="name" placeholder="Name">
          </div>
      </div>
      <div class="col">
          <div class="form-group">
              <label for="phone">Phone</label>
              <input type="tel" class="form-control" value="{{ $investor->phone }}" name="phone" id="phone" placeholder="Phone">
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col">
          <div class="form-group">
              <label for="present address">Present Address</label>
              <textarea name="present_address" id="presentaddress" cols="5" rows="5" class="form-control">{{ $investor->present_address }}</textarea>
          </div>
      </div> 
      <div class="col">
          <div class="form-group">
              <label for="permanent address">Permanent Address</label>
              <textarea name="permanent_address" id="permanent_address" cols="5" rows="5" class="form-control">{{ $investor->permanent_address }}</textarea>
          </div>
      </div>
  </div>   
  <div class="row">
      <div class="col">
          <div class="form-group">
              <label for="emargency contact">Emergency Contact</label>
              <input type="tel" class="form-control" name="emergency_contact" value="{{ $investor->emergency_contact }}" id="emergency contact" placeholder="Emergency Contact">
          </div>
      </div> 
      <div class="col">
          <div class="form-group">
              <label for="occupation">Occupation</label>
              <input type="text" class="form-control" name="occupation" value="{{ $investor->occupation }}" id="occupation" placeholder="Occupation">
          </div>
      </div>
  </div>           
  <div class="row">
      <div class="col">
          <div class="form-group">
              <label for="father">Father Name</label>
              <input type="text" class="form-control" name="father" value="{{$investor->parent_name->father}}" id="father" placeholder="Father Name">
          </div>
      </div> 
      <div class="col">
          <div class="form-group">
              <label for="discount_lastdate">Mother Name</label>
              <input type="text" class="form-control" name="mother" value="{{$investor->parent_name->mother}}" id="mother" placeholder="Mother Name">
          </div>
      </div>
  </div>
  @include('modules.checkbox', ['status' => $investor->status])
  <button type="submit" class="btn btn-primary btn-block" role="button"> Update</button>
</form>
@push('script')
  <script>
    function readupdateprofileimgURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = (e) => $('#showImage').attr('src', e.target.result);
            reader.readAsDataURL(input.files[0]);
        }
    }
  </script>
@endpush