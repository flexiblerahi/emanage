<style>
    .select2-results__option:hover{
          background-color: #3875d7 !important; 
          color:white !important;
      }
</style>
<form action="{{route('report.all')}}" method="post">
    @csrf
    <div class="form-group" id="option">
        <label for="type">Report Type</label>
        <select class="form-control select2" name="type" id="type">
            <option value="">Select Option</option>
            <option value="customers">Customer's Report</option>
            <option value="agents">Agent's Report</option>
            <option value="sale">Sale Report</option>
            <option value="deposit">Deposit Report</option>
            <option value="withdraw">Withdraw Report</option>
            <option value="allTransaction">All Transaction Report</option>
            <option value="expense">Expense Report</option>
            <option value="salary">Salaries Report</option>
            <option value="allexpenseday">All Expense Per Day Report</option>
            
        </select>
    </div>
    <div id="suboption" class="mb-2">

    </div>
    <div id="details"></div>
</form>
<div id="sale" class="d-none">
    <select name="saleInput" id="changevalue" class="form-control">
        <option value="">Select Option</option>
        <option value="shareholders">Total Sale Report</option>
        <option value="sale">Individual Sale Report</option>
        <option value="salePaymentDetails">Sale Payment Details Report</option>
        <option value="saleTransaction">Sale Transaction Report (Master Agent, Agent, General Manager)</option>
        <option value="commissionSingle">Commission Summery Report (Single Land)</option>
        <option value="commissionMultiple">Commission Summery Report (Multiple Land)</option>
    </select>
</div>

@push('script')
    <script src="{{url('daterangepicker-master/daterangepicker.js')}}"></script>
    <script>
        $(function () {
            $('#type').on('change', function() {
               let variable = $('#type').val();
               if(variable == 'sale') {
                    let duplicatedContent = $('#sale').html();
                    duplicatedContent = duplicatedContent.replace("changevalue", "saleInput");
                    console.log('duplica :>> ', duplicatedContent);
                    $('#details').empty();
                    $('#suboption').append(duplicatedContent);
               } else {
                    // $('#suboption').remove(duplicatedContent);
                    $('#suboption').empty();
                    $.ajax({
                        type: "GET",
                        url: "{{route('report.search')}}",
                        data: {
                            "type" : variable
                        },
                        success: function (response) {
                            $('#details').html(response);
                            if(variable == "expense") $('.select2').select2();
                            return dateRangeCall();
                        }
                    });
               }
               
            });

            $(document).on('change', '#saleInput', function() {
                let variable = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{route('report.search')}}",
                    data: {
                        "type" : variable
                    },
                    success: function (response) {
                        $('#details').html(response);
                        if(variable == "expense") $('.select2').select2();
                        if(variable == 'commissionSingle') $('#sale_user_id').select2();
                        if(variable == 'commissionMultiple') $('#sale_multiple_user_id').select2();
                        return dateRangeCall();
                    }
                });
            })

            
            function dateRangeCall() {
                $('#daterange').daterangepicker({
                    maxDate: new Date(),
                    "autoApply": false,
                    locale: {
                        format: 'DD/MM/YYYY',
                        customRangeLabel: "Custom Range",
                        applyLabel: "Apply",
                        cancelLabel: "Cancel"
                    },
                    ranges: {
                        "Today": [moment(), moment()],
                        "Yesterday": [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        "Last 7 Days": [moment().subtract(6, 'days'), moment()],
                        "Last 30 Days": [moment().subtract(29, 'days'), moment()],
                        "This Month": [moment().startOf('month'), moment().endOf('month')],
                        "Last Month": [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                        "This Year": [moment().startOf('year').startOf('month'), moment()],
                    },
                    "alwaysShowCalendars": true,
                });
            }
        });
    </script>
@endpush
@include('report.script')
@include('report.script.commission')