<link rel="stylesheet" href="{{url('css/datepicker.css')}}" type="text/css" />
<style>
  .select2-results__option:hover{
        background-color: #3875d7 !important; 
        color:white !important;
    }
</style>

<form id="withdrawSubmit" method="post">
    @csrf
    @method('put')
    <div class="row">
        <div class="col">
            <div class="form-group">
                <input type="text" class="form-control" data-user="withdraw" id="withdraw_details_phone" list="withdraw_details_list" value="{{$withdraw->user->phone}}" placeholder="Search by user phone number or Account Id">
                <datalist id="withdraw_details_list">
                </datalist>
            </div>
        </div>
    </div>
    <div id="withdrawInfo">
        @include('withdraw.userInfo', ['user' => $withdraw->user])
    </div>
    <div class="row">
        <div class="col">
            <label for="amount">Withdraw Amount</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">৳</span>
                </div>
                <input type="number" name="amount" id="amount" value="{{abs($withdraw->bank_transaction->amount)}}" class="form-control" aria-label="Amount" placeholder="Amount" min="0"/>
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="">Withdraw Date</label>
                <input id="date" type="text" class="form-control date-input bg-white" name="date" value="{{ getdateformat($withdraw->date) }}" @readonly(true)/>
            </div>
        </div>
    </div>
    @include('modules.edit_bank_transaction', ['model' => $withdraw])
    @include('modules.editor')
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="">Comment</label>
                <textarea class="form-control" name="comment" id="comment" rows="2" placeholder="Please enter comment that why need to update this section."></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col mb-4">
            <button type="submit" class="btn btn-outline-info">Make Withdraw</button>
        </div>
    </div>
</form>
@push('script')
    <script src="{{url('js/sale.js')}}"></script>
    <script src="{{url('js/banktrans.js')}}"></script>
    <script>
        $(function () {
            $('#date').datepicker({ format: "dd/mm/yyyy" });
            $('#amount').on('keyup', function () {  
                if($('#bank_balance').length > 0) {
                    const balance = parseInt($('#bank_balance').html());
                    const currentbalance = balance - parseInt($(this).val()); 
                    if(currentbalance < 1) toastr.error('Unsuffient Bank Balance');
                }
                if($('#userbalance').length>0) {
                    const balance = parseInt($('#userbalance').html());
                    const currentbalance = balance - parseInt($(this).val()); 
                    if(currentbalance < 1) toastr.error('Unsuffient User Balance');
                }
            })
            $('#amount').on('change', function () {
                if($('#bank_balance').length > 0) {
                    const balance = parseInt($('#bank_balance').html());
                    const currentbalance = balance - parseInt($(this).val()); 
                    if(currentbalance < 1) toastr.error('Unsuffient Bank Balance');
                }
                if($('#userbalance').length>0) {
                    const balance = parseInt($('#userbalance').html());
                    const currentbalance = balance - parseInt($(this).val()); 
                    if(currentbalance < 1) toastr.error('Unsuffient User Balance');
                }
            })
            $(document).on('submit', '#withdrawSubmit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "{{route('withdraw.update', $withdraw->id)}}",
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#income').text(response.amount);
                        swal({
                            title: "Withdraw Update Request Successfull!",
                            text: "Do you want to go Withdraw history?",
                            type: "success",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            cancelButtonText:'Stay Here.',
                            cancelButtonColor:'#A5DC86',
                            confirmButtonText: "Yes !",
                            closeOnConfirm: false
                        },
                        function() {
                            window.location ="{{route('withdraw.index')}}";
                        });
                    },
                    error: function (response) {
                        toastr.error(response.responseJSON.message);
                    }
                });
            })
        });
    </script>
@endpush