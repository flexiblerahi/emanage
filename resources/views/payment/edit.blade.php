@include('payment.style')
<div class="land_details">
    @include('modules.header', ['title' => 'Description of land', 'type' => 'land_details'])
    <div class="collapse show" id="land_details">
        @include('payment.landDetails')
    </div>
</div>
<form id="paymentSubmit" method="post">
    @csrf
    @method('PUT')
    <input type="hidden" name="sale" value="{{$sale->uuid}}">
    @include('modules.header', ['title' => 'Payment', 'type' => 'payment'])
    <div class="collapse show" id="payment">
        <div class="p-3">
            <div class="row">
                <div class="col-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button">Payment Type</button>
                        </div>
                        <select class="custom-select" name="type" id="inputGroupSelect03">
                            <option selected>Type</option>
                            @foreach ($commission_names as $key => $commission_name)
                                <option value="{{$key}}" @selected($key == $payment->commission_type)>{{$commission_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">৳</span>
                        </div>
                        <input type="number" name="amount" value="{{$payment->bank_transaction->amount}}" class="form-control" aria-label="Amount"/>
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="pay_at">Payment Date</label>
                        <input id="pay_at" type="text" class="form-control date-input bg-white" name="pay_at" value="{{ getdateformat($payment->bank_transaction->date) }}" @readonly(true)/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modules.edit_bank_transaction', ['model' => $payment])
    @include('modules.editor')
    <div class="row">
        <div class="col">
            <div class="form-group">
                <textarea class="form-control" name="comment" id="comment" rows="2" placeholder="Please enter comment that why need to update this section."></textarea>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col">
            <button type="submit" class="btn btn-outline-info">Update Payment</button>
        </div>
    </div>
</form>

<!-- payment  -->
<div class="customer_details">
    @include('modules.header', ['title' => 'Customer Information', 'type' => 'customer_details'])
    <div class="collapse show" id="customer_details">
        <div class="card-body" id="customerInfo">
            @include('sale.customerInfo', ['user' => $sale->customer])
        </div>
    </div>
</div>
<!-- Customer Details  -->
<div class="commission">
    @include('modules.header', ['title' => 'Commission', 'type' => 'Commission'])
    <div class="collapse show" id="Commission">
        <div class="p-1 card-body">
            @include('sale.commission')
        </div>
    </div>
</div>
<div class="reference">
    @include('modules.header', ['title' => 'Reference Details', 'type' => 'Reference'])
    <div class="collapse show border" id="Reference">
        <div class="card-body p-1">
            <div class="card-body border">
                @include('payment.referenceDetails')
            </div>
  
            @if (!is_null($sale->agent_id))
                <div class="card-body border mt-2">
                    @include('payment.referenceDetails', ['user' => $referenceUsers->where('role', 3)->first()])
                </div>
            @endif
        </div>
    </div>
</div>

@push('script')
    <script src="{{url('js/datepicker.js')}}"></script>
    <script src="{{url('js/banktrans.js')}}"></script>
    <script>
      $('#pay_at').datepicker({ format: "dd/mm/yyyy" });
      $(document).on('submit', '#paymentSubmit', function(e) {
        e.preventDefault();
        let formdata = $(this).serialize();
        $.ajax({
            type: "post",
            url: "{{route('deposit-payment.update', $payment->id)}}",
            data: formdata,
            success: function (response) {
                $('#income').text(response.amount);
                swal({
                    title: "Payment Request Successfull!",
                    text: "Do you want to go Payment history?",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText:'Stay Here.',
                    cancelButtonColor:'#A5DC86',
                    confirmButtonText: "Yes !",
                    closeOnConfirm: false
                },
                () => {
                    window.location ="{{route('deposit-payment.index')}}";
                });
            },
            error: function (response) {
              toastr.error(response.responseJSON.message);
            }
        });
      })
    </script>
@endpush