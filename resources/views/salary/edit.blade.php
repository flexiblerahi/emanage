<link rel="stylesheet" href="{{url('css/datepicker.css')}}" type="text/css" />
<style>
  .select2-results__option:hover{
        background-color: #3875d7 !important; 
        color:white !important;
    }
</style>
@include('modules.backbutton')
<form action="{{route('salary.update', $salary->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="">
        @include('modules.header', ['title' => 'Employee Details', 'type' => 'employee'])
        <div class="card collapse show" id="employee">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <input type="text" class="form-control" id="user_details_phone" value="{{$salary->user->phone}}" list="user_details_list" placeholder="Search by Employee phone number">
                            <datalist id="user_details_list">
                            </datalist>
                        </div>
                    </div>
                </div>
                <div id="userInfo">
                    @include('salary.userInfo', ['user' => $salary->user])
                </div>
            </div>
        </div>
    </div>
    <div class="my-2">
        <div class="payment">
          @include('modules.header', ['title' => 'Bank Transaction Details', 'type' => 'bank_trasaction'])
          <div class="p-2 border show collapse" id="bank_trasaction">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="bank_type">Bank Name</label>
                        <select class="form-control select2" name="bank_type" id="bank_type">
                            <option value="" selected>Select Bank Please</option>
                            
                            @foreach ($bankNames as $bankName)
                                    <option value="{{$bankName->id}}" @selected($bankName->id == $salary->bank_transaction->bank_info->bankname->id)>{{$bankName->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="account_number">Bank Account</label>
                        <select class="form-control select2" name="account_number" id="account_number">
                            <option  value="" selected>Select Account Number</option>
                            @foreach ($bankInfos as $info)
                                <option value="{{$info->id}}" @selected($info->id == $salary->bank_transaction->bank_info_id)>{{$info->account_id}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12" id="bankInfo">
                    @include('investment.bankInfo', ['bank_info' => $salary->bank_transaction->bank_info, 'transaction' => $salary->bank_transaction])
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="other">Other</label>
                        <textarea class="form-control" name="other" id="other" rows="2" placeholder="Bank any-other information if needed can be store here."></textarea>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
    @php
        $other_amount = '';
        $type_id = 0;
        if(!is_null($salary->type_id)) {
            $other_amount = abs($salary->bank_transaction->amount);
            $type_id = $salary->type_id;
        }
        if(isset($other_salary)) {
            $other_amount = abs($other_salary->bank_transaction->amount); 
            $type_id = $other_salary->type_id;
        }
    @endphp
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="type_id">Other Type <button type="button" class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#newsalarytype"><i class="fa fa-plus" aria-hidden="true"></i></button></label>
                <select class="form-control select2" name="type_id" id="type_id">
                    <option value="">Select Type</option>
                    @foreach ($salaryTypes as $type)
                        <option value="{{$type->id}}" @selected($type->id == $type_id)>{{$type->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
              <label for="other_amount">Other Amount</label>
              <input type="number" value="{{$other_amount}}" class="form-control" name="other_amount" id="other_amount" aria-describedby="otherAmountId" placeholder="Other Amount">
              <small id="otherAmountId" class="form-text text-muted">This Amount will be inserted by Depend on other type</small>
            </div>
        </div>
    </div>
    @php
        $salary_amount = '';
        if(is_null($salary->type_id)) $salary_amount = abs($salary->bank_transaction->amount);
        if(isset($main_salary)) $salary_amount = abs($main_salary->bank_transaction->amount);
    @endphp
    <div class="row">
        <div class="col">
            <div class="form-group">
              <label for="salary_amount">Salary Amount</label>
              <input type="number" value="{{$salary_amount}}" class="form-control" name="salary_amount" id="salary_amount" aria-describedby="mainAmountId" placeholder="Salary Amount">
              <small id="mainAmountId" class="form-text text-muted">This Amount will be counted as a salary of the employee</small>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="monthly">Monthly</label>
                <input type="month" class="form-control" aria-describedby="monthlyId" value="{{ $salary->monthly }}" name="monthly" id="monthly">
                <small id="monthlyId" class="form-text text-muted">Which Month Salary</small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="date">Date</label>
                <input id="date" type="text" class="form-control date-input bg-white" aria-describedby="dateId" name="date" value="{{ getdateformat($salary->bank_transaction->date) }}" @readonly(true)/>
                <small id="dateId" class="form-text text-muted">Bank Transaction Date</small>
            </div>
        </div>
    </div>
    @include('modules.editor')
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="">Comment</label>
                <textarea class="form-control" name="comment" id="comment" rows="2" placeholder="Please enter comment that why need to update this section."></textarea>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block" role="button"> Update</button>
</form>

<!-- New Salary Type form -->
<div class="modal fade" id="newsalarytype" tabindex="-1" role="dialog" aria-labelledby="newsalarytypeId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="newSalaryTypeForm" method="post">
            @csrf 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Salary Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" class="form-control" name="title" id="title" placeholder="Salary Type Name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
        
    </div>
</div>

@push('script')
    <script src="{{url('js/banktrans.js')}}"></script>
    <script>
        $(function () {
            $('#date').datepicker({ format: "dd/mm/yyyy" });
            var currentHost = (location.pathname.includes('real-state')) ? location.origin+ '/real-state' : location.origin;
            var timeoutId = null;
            $('#user_details_phone').on('input', function () {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(function() {
                    $.ajax({
                        type: "GET",
                        url: currentHost+'/employee-search',
                        data: { user: $('#user_details_phone').data('user'), query: $('#user_details_phone').val(), type: $('#user_details_phone').data('user') },
                        dataType: "json",
                        success: function (response) {
                            $('#userInfo').html('');
                            const users = response.users;
                            const phone = $("#user_details_phone").val();
                            $('#user_details_list').empty();
                            if(users.length < 1) {
                                toastr.warning('No User found!');
                                $('.user_detail').val('');
                            } else if(users.length>1) {
                                users.map((option) => $('#user_details_list').append('<option class="details" value="' + option.phone + '">Account No: '+option.account_id+'</option>'));
                            } else {
                                const phonevalue = (users[0].phone.includes(phone)) ? users[0].phone : users[0].account_id;
                                $("#user_details_phone").val(phonevalue);
                                $('#userInfo').html(response.view);
                            }
                        }
                    });
                }, 500);
            });
            $('#newSalaryTypeForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{route('type-salary.store')}}",
                    data: $("#newSalaryTypeForm").serialize(),
                    success: function (response) {
                        toastr.success('Salary Type Create Successfully!');
                        var select = $('#type_id');
                        var newOption = new Option(response.salaryType.title, response.salaryType.id);
                        select.append(newOption);
                        select.trigger('change');
                    },
                    error: (response) => $.each(response.responseJSON.errors, (field, messages) => toastr.error(messages))
                });
            });

            $('#salary_amount').on('change', () => checkBalance());
            $('#other_amount').on('input', () => checkBalance());

            function checkBalance() {
                const salary_amount = ($('#salary_amount').val() == '') ? 0 : parseInt($('#salary_amount').val());
                const other_amount = ($('#other_amount').val() == '') ? 0 : parseInt($('#other_amount').val());
                const amnt = salary_amount + other_amount;
                const balance = parseInt($('#bank_balance').html());
                console.log('balance :>> ', balance);
                if(balance) {
                    if(amnt>balance) toastr.error('Insufficient Balance');
                }
                else toastr.error('Please Select Bank first!');
            }
        });
    </script>
@endpush