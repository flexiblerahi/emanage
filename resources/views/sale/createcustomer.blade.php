<div class="modal fade" id="customerModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid ">
                    <form id="onCustomerForm" method="POST">  
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="Full Name">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="account_id">Account Id</label>
                                    <input type="text" class="form-control" name="account_id" id="account_id" placeholder="Account Number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="present address">Present Address</label>
                                    <textarea name="present_address" id="present_address" cols="5" rows="5" class="form-control"></textarea>
                                    <span id="praddresserr" class="text-danger fw-bold"></span>
                                </div>
                            </div> 
                            <div class="col">
                                <div class="form-group">
                                    <label for="permanent address">Permanent Address</label>
                                    <textarea name="permanent_address" id="permanent_address" cols="5" rows="5" class="form-control"></textarea>
                                    <span id="perddresserr" class="text-danger fw-bold"></span>
                                </div>
                            </div>
                        </div>   
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="emargency contact">Emergency Contact</label>
                                    <input type="tel" class="form-control" name="emergency_contact" id="emergency_contact" placeholder="Emergency Contact">
                                    <span id="econtacterr" class="text-danger fw-bold"></span>
                                </div>
                            </div> 
                            <div class="col">
                                <div class="form-group">
                                    <label for="occupation">Occupation</label>
                                    <input type="text" class="form-control" name="occupation" id="occupation" placeholder="Occupation">
                                    <span id="occupationerr" class="text-danger fw-bold"></span>
                                </div>
                            </div>
                        </div>           
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="father">Father Name</label>
                                    <input type="text" class="form-control" name="father" id="father" placeholder="Father Name">
                                    <span id="fathererr" class="text-danger fw-bold"></span>
                                </div>
                            </div> 
                            <div class="col">
                                <div class="form-group">
                                    <label for="discount_lastdate">Mother Name</label>
                                    <input type="text" class="form-control" name="mother" id="mother" placeholder="Mother Name">
                                    <span id="mothererr" class="text-danger fw-bold"></span>
                                </div>
                            </div>
                        </div>
                        <button type="button" data-url="{{route('customer.store')}}" class="btn btn-primary btn-block" id="customersave">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>