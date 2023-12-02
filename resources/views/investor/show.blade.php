<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img style="height: 150px; width: 150px; border-radius: 50%;" src="{{ setImage($investor->image,'') }}">
                            <div class="mt-3">
                                <h6 class="text-dark font-weight-bold">Name: {{$investor->name}}</h6>
                                <h6 class="text-dark font-weight-bold">Account ID: {{$investor->account_id}}</h6>
                                <h6 class="text-dark font-weight-bold">Phone: {{$investor->phone}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                
                <a class="btn btn-primary mt-2" href="{{route('investor-base.commission', $investor->id)}}">Investment Commissions</a>
            </div>

            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-0 text-dark font-weight-bold">Father Name</h6>
                            </div>
                            <div class="col-sm-8 text-secondary">
                                {{$investor->parent_name->father}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-0 text-dark font-weight-bold">Mother Name</h6>
                            </div>
                            <div class="col-sm-8 text-secondary">
                                {{$investor->parent_name->mother}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-0 text-dark font-weight-bold">Emergency Contact</h6>
                            </div>
                            <div class="col-sm-8 text-secondary">
                                {{$investor->emergency_contact}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-0 text-dark font-weight-bold">Present Address</h6>
                            </div>
                            <div class="col-sm-8 text-secondary">
                                {{$investor->present_address}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-0 text-dark font-weight-bold">Permanent Address</h6>
                            </div>
                            <div class="col-sm-8 text-secondary">
                                {{$investor->permanent_address}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-0 text-dark font-weight-bold">Current Amount</h6>
                            </div>
                            <div class="col-sm-8 text-secondary">
                                {{$investor->income}} Taka
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-0 text-dark font-weight-bold">Created At</h6>
                            </div>
                            <div class="col-sm-8 text-secondary">
                                {{ $investor->created }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-0 text-dark font-weight-bold">Updated At</h6>
                            </div>
                            <div class="col-sm-8 text-secondary">
                                {{ $investor->updated}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <h6 class="mb-0 text-dark font-weight-bold">Status</h6>
                            </div>
                            <div class="col-sm-8 text-secondary">
                                @if ($investor->status == 0)
                                    <span class="font-weight-bold">Deactive</span>
                                @else
                                    <span class="font-weight-bold">Active</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>