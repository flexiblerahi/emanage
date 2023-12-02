<div class="container">
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img style="height: 150px; width: 150px; border-radius: 50%;" src="{{ setImage($agent->image,'') }}">
                    <div class="mt-3">
                      <h6 class="text-dark font-weight-bold">Name: {{$agent->name}}</h6>
                      <h6 class="text-dark font-weight-bold">Account ID: {{$agent->account_id}}</h6>
                      <h6 class="text-dark font-weight-bold">Phone: {{$agent->phone}}</h6>
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
                        {{$agent->parent_name->father}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Mother Name</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        {{$agent->parent_name->mother}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Emergency Contact</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        {{$agent->emergency_contact}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Present Address</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        {{$agent->present_address}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Permanent Address</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        {{$agent->permanent_address}}
                    </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-4">
                        <h6 class="mb-0 text-dark font-weight-bold">Income</h6>
                      </div>
                      <div class="col-sm-8 text-secondary">
                          {{$agent->income}} Taka
                      </div>
                      </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-4">
                        <h6 class="mb-0 text-dark font-weight-bold">Total Katha</h6>
                      </div>
                      <div class="col-sm-8 text-secondary">
                          {{$agent->total_kata}}
                      </div>
                      </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-4">
                        <h6 class="mb-0 text-dark font-weight-bold">Created At</h6>
                      </div>
                      <div class="col-sm-8 text-secondary">
                        {{ $agent->created }}
                      </div>
                      </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-4">
                        <h6 class="mb-0 text-dark font-weight-bold">Updated At</h6>
                      </div>
                      <div class="col-sm-8 text-secondary">
                        {{ $agent->updated}}
                      </div>
                      </div>
                    <hr>
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="control-label">{{trans('Status')}}</div>
                            <label class="custom-switch pl-0 mt-2">
                                <input data-id="status-{{$agent->id}}" @checked($agent->status == 1) type="checkbox"
                                class="custom-switch-input"
                                data-url = "{{route('update-status', ['user' => 'agent', 'id' => $agent->id])}}">

                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Active / Deactive</span>
                            </label>
                        </div>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="col-md mt-3 text-right">
                      @can('report-sale-individual')
                        <button class="btn btn-primary" data-toggle="modal" data-target="#saleId">Sale Report</button>
                      @endcan
                      @can('report-customers')
                        <button class="btn btn-primary" data-toggle="modal" data-target="#customerId">Customer's Report</button>
                      @endcan
                      @can('report-withdraw')
                        <button class="btn btn-primary" data-toggle="modal" data-target="#withdrawId">Withdraw's Report</button>
                      @endcan
                      @can('report-transaction')
                        <button class="btn btn-primary" data-toggle="modal" data-target="#transactionId">Transaction's Report</button>
                      @endcan
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    @include('report.modalform', ['route' => route("report.customer"), 'id' => 'customerId', 'user_id' => $agent->id])
    @include('report.modalform', ['route' => route("report.sale"), 'id' => 'saleId', 'user_id' => $agent->id])
    @include('report.modalform', ['route' => route("report.withdraw"), 'id' => 'withdrawId', 'user_id' => $agent->id])
    @include('report.modalform', ['route' => route("report.transaction"), 'id' => 'transactionId', 'user_id' => $agent->id])