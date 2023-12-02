
@push('script')
    <script src="{{url('js/sale.js')}}"></script>
    <script src="{{url('js/datepicker.js')}}" type="text/javascript"></script>
    <script> 
        $(document).on('keyup', '.kataprice', function() {
            let price = $('#price').val();
            let kata = $('#kata').val();
            if(price == "") price = 0;
            if(kata == "") kata = 0;
            $('#totalprice').val(parseFloat(price) * parseFloat(kata));
        })
        $(document).on('keyup', '.user', function () {
            let id = $(this).attr('id');
            return changeCommission(id);
        })
        $(document).on('change', '.user', function () {
            let id = $(this).attr('id');
            return changeCommission(id);
        });

        function changeCommission(id) {
            let totalId = $('#'+ id).attr('total');
            let value = $('#'+ id).val();
            let classes = id.split("-");
            if(value == "") {
                value = 0;
                $('#'+id).val(value);
            } else value = parseFloat(value).toFixed(2);
            let sum = 0;
            $('.'+classes[1]).each(function() {
                sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText

            });
            sum = sum.toFixed(2);
            const totalvalue = parseFloat(totalId).toFixed(2);
            let total = totalvalue - sum;
            total = total.toFixed(2);
            if(total<0) {
                toastr.error($('#'+ id).attr('commission-name')+" Can't be greater than total-"+totalId+" %.")
            } else $('#'+classes[1]).text(total + '%');
        }
        $(function () {
            $('#txtDate').datepicker({
                format: "dd/mm/yyyy"
            });
        });
    </script>
@endpush