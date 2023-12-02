<div class="container">
    <section class="section">
        <div class="section-body">

            <div class="card border-left-primary shadow">
                <div class="card-header">
                    <h4>Balance: <span id="income">{{$auth_user_details->income}}</span></h4>
                </div>
                <div class="card-body">
                    <form id="withdrawSubmit" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="amount">Withdraw Amount</label>
                            <div class="input-group mb-3">
                                
                                <div class="input-group-prepend">
                                    <span class="input-group-text">৳</span>
                                </div>
                                <input type="hidden" name="withdraw_phone" value="{{$auth_user_details->phone}}">
                                <input type="number" name="amount" id="amount" class="form-control" aria-label="Amount" placeholder="Amount" min="0"/>
                                <input type="hidden" value="{{ now()->format('Y-m-d') }}" class="form-control" name="withdraw_at" id="saledate" placeholder="Withdraw Date">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-info">Make Withdraw</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@push('script')
    <script>
        $(document).ready(function () {
            const user_details =  @json($auth_user_details);
            $(document).on('submit', '#withdrawSubmit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "{{route('withdraw.store')}}",
                    data: $(this).serialize(),
                    success: function (response) {
                        console.log('response :>> ', response);
                        toastr.success(response.message);
                        let current = parseInt($('#amount').val());
                        let income = parseInt($('#income').text());
                        $('#income').text(income-current);
                    },
                    error: function (response) {
                        console.log('response :>> ', response);
                        toastr.error(response.responseJSON.message);
                    }
                });
            })
            $(document).on('input', '#amount', function() {
                const current = parseInt($(this).val());
                const income = parseInt($('#income').text());
                if(current>income) toastr.warning('Insufficient Balance');
                if(current<0) $(this).val(0);
            });

        });
    </script>
@endpush