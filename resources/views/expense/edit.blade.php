<link rel="stylesheet" href="{{url('css/datepicker.css')}}" type="text/css" />
@include('modules.backbutton')
@include('expense.expenseTypeCreateModal')
    <div class="row mb-3">
        <div class="col">
            @include('modules.header', ['title' => 'Expense Types', 'type' => 'expense'])
            <div class="card show" id="expense">
                <div class="container mt-2">
                    @foreach ($typesParents as $key => $value)
                        @php
                            $expenseItems = $expenseTypes->where('parent', $value);
                            $parentKey = $key + 1;
                            $previous = (($key-1) > 0) ? 'optiontitle_'.$typesParents[$key - 1] : 'optiontitle_0';
                        @endphp
                        @if(array_key_exists($parentKey, $typesParents))
                            @if(is_null($value))
                                <div id="parentoptions">
                                    @include('expenseItem.editOptions', ['expenseItems' => $expenseItems, 'selected' => $typesParents[$parentKey], 'end' => end($typesParents)])
                                </div>
                            @else
                                @push('otheroptions')
                                    @include('expenseItem.editOptions', ['expenseItems' => $expenseItems, 'previous' => $previous, 'selected' => $typesParents[$parentKey], 'parent' => $expenseTypes->where('id', $value)->first(), 'end' => end($typesParents)])
                                @endpush
                            @endif
                        @endif
                    @endforeach
                    <div id="otheroptions">
                        @stack('otheroptions')
                    </div>
                </div>
            </div>
        </div>
    </div>
<form action="{{route('expense.update', $expense->id)}}" enctype="multipart/form-data" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="expense_item_id" id="expense_item_id" value="{{$expense->expense_item_id}}">
    @include('modules.edit_bank_transaction', ['model' => $expense])
    @include('modules.header', ['title' => 'Other Information', 'type' => 'expenseOtherInfo'])
    <div class="card show p-2" id="expenseOtherInfo">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" value="{{abs($expense->bank_transaction->amount)}}" class="form-control" id="amount" name="amount" required placeholder="Expense Amount">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="date">Pay At</label>
                    <input id="date" type="text" class="form-control date-input bg-white" name="date" value="{{ getdateformat($expense->bank_transaction->date) }}" @readonly(true)/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="document">Expense Document(If need) @if(!is_null($expense->document))<span><a href="{{url($expense->document)}}">Previous Document</a></span> @endif</label>
                    <input type="file" class="form-control" name="document" id="document">
                </div>
            </div>
        </div>
    </div>

    @include('modules.editor')
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="Please describe why need to change this information. please">{{$expense->comment}}</textarea>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block" role="button"> Update</button>
</form>
@push('script')
    <script src="{{url('js/datepicker.js')}}" type="text/javascript"></script>
    <script src="{{url('js/expense.js')}}"></script>
    <script src="{{url('js/banktrans.js')}}"></script>
    <script>
        $(function () {
            $('#date').datepicker({ format: "dd/mm/yyyy" });
            // start 
            $(document).on('change', '.suboptions', function () {
                // alert('found');
                var value = $(this).val();
                var id = $(this).attr('id');
                console.log('value :>> ', value, id);
                // $('#expense_item_id').val(value);
                // if(value != '') {
                    $.ajax({
                        type: "GET",
                        url: "{{route('expense-item.submenu')}}",
                        data: {
                            "id" : value,
                            "edit" : true,
                        },
                        success: function (response) {
                            if(response.expenseItems.length > 0) {
                                toastr.success('Expense Item found.');
                                $('#expense_item_id').val(null);
                                $('#'+id).attr("disabled", true);
                                $('#otheroptions').append(response.view);
                                $('#remove-'+value).data('parentselect', id);
                                $('#optiontitle_'+value).select2();
                                $('[id^="remove"]').addClass('d-none');
                                // Show the last element
                                $('[id^="remove"]').last().removeClass('d-none');
                            } else {
                                toastr.success('No Sub Expense Item found.');
                            }
                        },
                        
                    });
                // }
            });
            // end 
            // $(document).on('click', '.addnewbtn', function () {
            //     let modalform = $('#addnew').html();
            //     modalform = modalform.replace(/title_\w{1,4}/g, "title_"+ $(this).data('parent'));
            //     $('#addnew').html(modalform);
            // });

            $(document).on('click', '.removebtn', function () {
                console.log('$(this) :>> ', $(this).data('parentselect'));
                $('#'+$(this).data('parentselect')).attr("disabled", false);
                console.log('$(this).data() :>> ', $(this).data());
                $('#options-'+$(this).data('parent')).remove();
                if(location.pathname.includes('pos')) $('#expense_item_id').val(null);

                $('[id^="remove"]').addClass('d-none');
  
                // Show the last element
                $('[id^="remove"]').last().removeClass('d-none');
            });
        });
    </script>
@endpush