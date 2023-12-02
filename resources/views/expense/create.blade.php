<link rel="stylesheet" href="{{url('css/datepicker.css')}}" type="text/css"/>
<style>
    .select2-results__option:hover{
        background-color: #3875d7 !important; 
        color:white !important;
    }
</style>
@include('modules.backbutton')
@include('expense.expenseTypeCreateModal')
<div class="row mb-3">
    <div class="col">
        @include('modules.header', ['title' => 'Expense Types', 'type' => 'expense'])
        <div class="card show" id="expense">
            <div class="container mt-2">
                {{-- start --}}
                    @include('expenseItem.editOptions')
                {{-- end  --}}
                <div id="otheroptions">
                </div>
            </div>
        </div>
    </div>
</div>
<form action="{{route('expense.store')}}" enctype="multipart/form-data" method="POST">
    @csrf
    <input type="hidden" name="expense_item_id" id="expense_item_id">
    @include('modules.bank_transaction')
    @include('modules.header', ['title' => 'Other Information', 'type' => 'otherinfo'])
    <div class="card show p-2 mb-2" id="otherinfo">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" required placeholder="Expense Amount">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="date">Pay At</label>
                    <input id="date" type="text" class="form-control date-input bg-white" name="date" value="{{ now()->format('d/m/Y') }}" @readonly(true)/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="document">Expense Document(If need)</label>
                    <input type="file" class="form-control" name="document" id="document">
                    
                </div>
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary btn-block" role="button"> Save</button>
</form>
@push('script')
    <script src="{{url('js/datepicker.js')}}" type="text/javascript"></script>
    <script src="{{url('js/expense.js')}}"></script>
    <script src="{{url('js/banktrans.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#date').datepicker({ format: "dd/mm/yyyy" });
            $(document).on('change', '.suboptions', function () {
                var value = $(this).val();
                var id = $(this).attr('id');
                $('#expense_item_id').val(value);
                if(value != '') {
                    $.ajax({
                        type: "GET",
                        url: "{{route('expense-item.submenu')}}",
                        data: {
                            "id" : value,
                            "edit" : true
                        },
                        success: function (response) {
                            console.log('response :>> ', response);
                            if(response.expenseItems.length > 0) {
                                $('#expense_item_id').val(null);
                                $('#'+id).attr("disabled", true);
                                $('#otheroptions').append(response.view);
                                $('#remove-'+value).data('parentSelect', id);
                                $('#optiontitle_'+value).select2();
                                $('[id^="remove"]').addClass('d-none');
                                // Show the last element
                                $('[id^="remove"]').last().removeClass('d-none');
                            }
                        },
                        
                    });
                }
            });
            $(document).on('click', '.removebtn', function () {
                // console.log('$(this) :>> ', $(this).data('parentselect'));
                let data = $(this).data();

                $('#'+data.parentSelect).attr("disabled", false);
                console.log('data:: ', data);
                $('#options-'+data.parent).remove();
                if(location.pathname.includes('pos')) $('#expense_item_id').val(null);

                $('[id^="remove"]').addClass('d-none');
  
                // Show the last element
                $('[id^="remove"]').last().removeClass('d-none');
            });
        });
    </script>
@endpush