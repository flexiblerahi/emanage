
<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img style="height: 150px; width: 150px; border-radius: 50%;" src="{{ setImage($accountant->image,'') }}">
                            <div class="mt-3">
                                <h6 class="text-dark font-weight-bold">Name: {{ $accountant->name}}</h6>
                                <h6 class="text-dark font-weight-bold">Account ID: {{ $accountant->account_id}}</h6>
                                <h6 class="text-dark font-weight-bold">Phone: {{ $accountant->phone}}</h6>
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
                                {!! emergencyContact($accountant->parent_name->father) !!}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-0 text-dark font-weight-bold">Mother Name</h6>
                            </div>
                            <div class="col-sm-8 text-secondary">
                                {!! emergencyContact($accountant->parent_name->mother) !!}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-0 text-dark font-weight-bold">Emergency Contact</h6>
                            </div>
                            <div class="col-sm-8 text-secondary">
                                {!! emergencyContact($accountant->emergency_contact) !!}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-0 text-dark font-weight-bold">Present Address</h6>
                            </div>
                            <div class="col-sm-8 text-secondary">
                                {!! emergencyContact($accountant->present_address) !!}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-0 text-dark font-weight-bold">Permanent Address</h6>
                            </div>
                            <div class="col-sm-8 text-secondary">
                                {!! emergencyContact($accountant->permanent_address) !!}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-0 text-dark font-weight-bold">Created At</h6>
                            </div>
                            <div class="col-sm-8 text-secondary">
                                {{ $accountant->created }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-0 text-dark font-weight-bold">Updated At</h6>
                            </div>
                            <div class="col-sm-8 text-secondary">
                                {{ $accountant->updated }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="control-label">Status</div>
                                    <label class="custom-switch pl-0 mt-2">
                                        <input data-id="status-{{$accountant->id}}" @checked($accountant->status == 1) type="checkbox"
                                        class="custom-switch-input"
                                        data-url = "{{route('update-status', ['user' => 'accountant', 'id' => $accountant->id])}}">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Active / Deactive</span>
                                    </label>
                                </div>
                               
                            </div>
                            <div class="col-md-6 mt-3 text-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>