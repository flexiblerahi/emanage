<div class="container">
  <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img style="height: 150px; width: 150px; border-radius: 50%;" src="{{ setImage($employee->image,'') }}">
                    <div class="mt-3">
                      <h6 class="text-dark font-weight-bold">Name: {{$employee->name}}</h6>
                      <h6 class="text-dark font-weight-bold">Account ID: {{$employee->account_id}}</h6>
                      <h6 class="text-dark font-weight-bold">Phone: {{$employee->phone}}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Father Name</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        {{$employee->parent_name->father}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Mother Name</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        {{$employee->parent_name->mother}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Emergency Contact</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        {{$employee->emergency_contact}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Present Address</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        {{$employee->present_address}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Permanent Address</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        {{$employee->permanent_address}}
                    </div>
                    </div>  
                    <hr>
                    <div class="row">
                      <div class="col-sm-4">
                        <h6 class="mb-0 text-dark font-weight-bold">Created At</h6>
                      </div>
                      <div class="col-sm-8 text-secondary">
                        {{ $employee->created }}
                      </div>
                      </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-4">
                        <h6 class="mb-0 text-dark font-weight-bold">Updated At</h6>
                      </div>
                      <div class="col-sm-8 text-secondary">
                        {{ $employee->updated}}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-4">
                        <h6 class="mb-0 text-dark font-weight-bold">Status</h6>
                      </div>
                      <div class="col-sm-8 text-secondary">
                        {!! setStatus($employee->status) !!}
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</div>