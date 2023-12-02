<input type="hidden" name="user_id" value="{{$user->id}}">
<input type="hidden" name="reference_id" value="{{$user->phone}}">
<div class="row">
  <div class="col">
      <div class="form-group">
          <label class="text-info font-weight-bold" for="name">Name</label>
          <p id="ag_sh_name">{{$user->name}}</p>
      </div>
  </div>
  <div class="col">
      <div class="form-group">
          <label class="text-info font-weight-bold" for="name">Phone</label>
          <p id="ag_sh_email">{{$user->phone}}</p>
      </div>
  </div>
  <div class="col">
      <div class="form-group">
          <label class="text-info font-weight-bold" for="name">Account Id</label>
          <p id="ag_sh_email">{{$user->account_id}}</p>
      </div>
  </div>
  <div class="col">
      <div class="form-group">
          <label class="text-info font-weight-bold" for="name">Role</label>
          <p id="ag_sh_role">{{$user->role_name}}</p>
      </div>
  </div>
</div>
