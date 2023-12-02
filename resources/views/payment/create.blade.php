
@include('payment.style')
<div>
  <div class="land_details">
    @include('modules.header', ['title' => 'Description of land', 'type' => 'land_details'])
    <div class="collapse show border" id="land_details">
      @include('payment.landDetails')
    </div>
  </div>
  <!-- land_details  -->
  <div class="payment">
    @include('modules.header', ['title' => 'Payment', 'type' => 'payment'])
    <div class="collapse show border" id="payment">
      <form id="paymentSubmit" method="post">
        @csrf
        <div class="p-3">
          <div class="row">
            <div class="col-6">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button class="btn btn-outline-secondary" type="button">Payment Type</button>
                </div>
                <select class="custom-select" name="type" id="inputGroupSelect03">
                  <option value="" selected>Payment Selection Type</option>
                  @foreach ($commission_names as $key => $commission_name)
                    <option value="{{$key}}">{{$commission_name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">৳</span>
                </div>
                <input type="number" name="amount" class="form-control" aria-label="Amount" placeholder="Payment Amount"/>
                <div class="input-group-append">
                  <span class="input-group-text">.00</span>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="pay_at">Payment Date</label>
                <input id="pay_at" type="text" class="form-control date-input bg-white" name="pay_at" value="{{ now()->format('d/m/Y') }}" @readonly(true)/>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="bank_type">Bank Name</label>
                <select class="form-control select2" name="bank_type" id="bank_type">
                  <option value="" selected>Select Bank Please</option>
                  @foreach ($bankNames as $bankName)
                    <option value="{{$bankName->id}}">{{$bankName->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="account_number">Bank Account</label>
                <select class="form-control select2" name="account_number" id="account_number">
                  <option  value="" selected>Select Account Number</option>
                </select>
              </div>
            </div>
            <div class="col-12" id="bankInfo">
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="other">Month of payment/ Other</label>
                <textarea class="form-control" name="other" id="other" rows="2" placeholder="Bank any-other information if needed can be store here."></textarea>
              </div>
            </div>
            <div class="col-12 text-right">
              <button type="submit" class="btn btn-outline-primary">Make Payment</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- payment  -->
  <div class="customer_details">
    @include('modules.header', ['title' => 'Customer Information', 'type' => 'customer_details'])

    <div class="collapse show border" id="customer_details">
      <div class="card-body" id="customerInfo">
        @include('sale.customerInfo', ['user' => $sale->customer])
      </div>
    </div>
  </div>
  <!-- Customer Details  -->
</div>
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
            url: "{{route('deposit-payment.store', ['sale' => $sale->uuid])}}",
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