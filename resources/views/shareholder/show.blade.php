<div class="container">
    <div class="main-body">
          @canany(['report-sale-individual','report-customers', 'report-agents', 'report-withdraw', 'report-transaction'])
            <div class="row mb-2">
              @can('report-sale-individual')
                <div class="col-md text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#saleId">Sale Report</button>
                </div>
              @endcan
              @can('report-customers')
                <div class="col-md">
                  <button class="btn btn-primary" data-toggle="modal" data-target="#customerId">Customer's Report</button>
                </div>
              @endcan
              @can('report-agents')
                <div class="col-md">
                  <button class="btn btn-primary" data-toggle="modal" data-target="#agentId">Agent's Report</button>
                </div>
                <div class="col-md">
                  <button class="btn btn-primary" data-toggle="modal" data-target="#agentDetailsId">Agent's  Details Report</button>
                </div>
              @endcan
              @can('report-withdraw')
                <div class="col-md">
                  <button class="btn btn-primary" data-toggle="modal" data-target="#withdrawId">Withdraw's Report</button>
                </div>
              @endcan
              @can('report-transaction')
                <div class="col-md">
                  <button class="btn btn-primary" data-toggle="modal" data-target="#transactionId">Transaction's Report</button>
                </div>
              @endcan
            </div>
          @endcanany
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img style="height: 150px; width: 150px; border-radius: 50%;" src="{{ setImage($shareholder->image,'') }}">
                    <div class="mt-3">
                      <h6 class="text-dark font-weight-bold">Name: {{$shareholder->name}}</h6>
                      <h6 class="text-dark font-weight-bold">Account ID: {{$shareholder->account_id}}</h6>
                      <h6 class="text-dark font-weight-bold">Phone: {{$shareholder->phone}}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Father Name</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        {{$shareholder->parent_name->father}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Mother Name</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        {{$shareholder->parent_name->mother}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Emergency Contact</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        {{$shareholder->emergency_contact}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Present Address</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        {{$shareholder->present_address}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Permanent Address</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        {{$shareholder->permanent_address}}
                    </div>
                    </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Income</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        {{$shareholder->income}}
                    </div>
                    </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Total Katha</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                        {{$shareholder->total_kata}}
                    </div>
                    </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Created At</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                      {{ $shareholder->created }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">
                      <h6 class="mb-0 text-dark font-weight-bold">Updated At</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                      {{ $shareholder->updated }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="control-label">{{trans('Status')}}</div>
                            <label class="custom-switch pl-0 mt-2">
                                <input data-id="status-{{$shareholder->id}}" @checked($shareholder->status == 1) type="checkbox"
                                  class="custom-switch-input"
                                  data-url = "{{route('update-status', ['user' => 'shareholder', 'id' => $shareholder->id])}}">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">OFF/ON</span>
                            </label>
                        </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    @include('report.modalform', ['route' => route("report.sale"), 'id' => 'saleId', 'user_id' => $shareholder->id])
    @include('report.modalform', ['route' => route("report.customer"), 'id' => 'customerId', 'user_id' => $shareholder->id])
    @include('report.modalform', ['route' => route("report.agent"), 'id' => 'agentId', 'user_id' => $shareholder->id])
    @include('report.modalform', ['route' => route("report.agent.details"), 'id' => 'agentDetailsId', 'user_id' => $shareholder->id])
    @include('report.modalform', ['route' => route("report.withdraw"), 'id' => 'withdrawId', 'user_id' => $shareholder->id])
    @include('report.modalform', ['route' => route("report.transaction"), 'id' => 'transactionId', 'user_id' => $shareholder->id])
    