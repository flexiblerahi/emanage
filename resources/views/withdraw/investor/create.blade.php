<link rel="stylesheet" href="{{url('css/datepicker.css')}}" type="text/css" />
<style>
    .shadow > .card-body {
        padding: 0 !important;
    }
    .select2-results__option:hover{
        background-color: #3875d7 !important; 
        color:white !important;
    }
</style>
<form id="withdrawSubmit" method="post">
    @csrf
    <div class="row mb-3">
        <div class="col">
          @include('modules.header', ['title' => 'Investor Details', 'type' => 'investor'])
            <div class="collapse show border container pt-2" id="investor">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input type="text" class="form-control" name="investor_phone" data-user="investor" id="investor_details_phone" list="investor_details_list" placeholder="Search by investor phone number or account number">
                            <datalist id="investor_details_list">
                            </datalist>
                        </div>
                    </div>    
                </div>
                <div class="card-body" id="investorInfo">
                </div>
            </div>
        </div>
    </div>
    <div class="row p-2">
        <div class="col">
            <label for="amount">Withdraw Amount</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">৳</span>
                </div>
                <input type="number" name="amount" id="amount" class="form-control" aria-label="Amount" placeholder="Amount" min="0"/>
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="">Withdraw Date</label>
                <input id="date" type="text" class="form-control date-input bg-white" name="date" value="{{ now()->format('d/m/Y') }}" @readonly(true)/>
            </div>
        </div>
    </div>
    
    @include('modules.bank_transaction')
    <div class="row">
        <div class="col mb-4 ml-3">
            <button type="submit" class="btn btn-outline-info" id="submitBtn">Make Withdraw</button>
        </div>
    </div>
</form>
@push('script')

    <script src="{{url('js/banktrans.js')}}"></script>
    <script src="{{url('js/investment.js')}}"></script>
    <script>
        $(function () {
           
            $('#date').datepicker({ format: "dd/mm/yyyy" });
            
            $(document).on('submit', '#withdrawSubmit', function(e) {
                e.preventDefault();
                let amount = $('#amount').val();
                if(amount == '') {
                    toastr.warning('Please Input amount first.');
                    return;
                } else amount = parseFloat(amount);
                if($('#investor_balance').length < 1) {
                    toastr.warning('Please Select an Investor first.');
                    return;
                }
                const balance =parseFloat($('#investor_balance').html());
                if(amount>balance) {
                    toastr.warning('Insuffient Investor Balance.');
                    return;
                }
                if($('#bank_balance').length < 1) {
                    toastr.warning('Please Bank first.');
                    return;
                }
                let bankBalance = parseFloat($('#bank_balance').html());
                if(amount>bankBalance) {
                    toastr.warning('Insuffient Bank Balance');
                    return;
                }
                $('#submitBtn').prop("disabled", true);
                $.ajax({
                    type: "post",
                    url: "{{route('investment-withdraw.store')}}",
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#income').text(investor_balance.amount);
                        $('#submitBtn').prop("disabled", false);
                        swal({
                            title: "Investor Withdraw Request Successfully Done",
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
                            window.location ="{{route('investment-withdraw.index')}}";
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