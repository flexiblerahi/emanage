@push('script')
<script>
    $(function () {
        let role = 'customer';
        let sale_user_id = '';

        $(document).on('change', '#role', function() {
            role = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{route('report.user-detail.list')}}",
                data: {
                    role: role,
                },
                dataType: "json",
                success: function (response) {
                    let firstOption = $('#sale_user_id option:first-child');
                    $('#sale_user_id').empty().append(firstOption);
                    // Add back the selected options
                    response.users.forEach((user) => {
                        $('#sale_user_id').append(`<option value="${user.id}">${user.name} (${user.phone})</option>`);
                    });
                    // Refresh Select2
                    $('#sale_user_id').trigger('change');
                }
            });
        });

        $(document).on('change', '#sale_user_id', function() {
            sale_user_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{route('report.commission-sale-list')}}",
                data: {
                    role : role,
                    user_id: sale_user_id
                },
                dataType: "json",
                success: function (response) {
                    $('#landdetils tbody').find("tr").remove();
                    let addrows = '';
                    if(response.length>0) {
                        response.map((sale) => {
                            addrows += '<tr class="singlelandSales" style="cursor:pointer;" data-id="'+sale.id+'">';
                            addrows += '<td><label class="form-check-label pl-4 pb-5"><input type="radio" style="height:35px;width:35px" class="form-check-input" name="sale_id" id="singleLandCheck-'+sale.id+'" value="'+sale.id+'"></label></td>';
                            addrows += '<td>'+sale.sector+'</td>';
                            addrows += '<td>'+sale.block+'</td>';
                            addrows += '<td>'+sale.road+'</td>';
                            addrows += '<td>'+sale.price+' tk</td>';
                            addrows += '<td>'+sale.kata+'</td>';
                            addrows += '<td>'+sale.plot+'</td>';
                            addrows += '<td>'+sale.date+'</td>';
                           
                            addrows += '<tr>';
                        })
                    } else {
                        toastr.error('No Data Found');
                        addrows += '<tr>';
                        addrows += '<td colspan="7" class="text-center">No Data is Found.</td>';
                        addrows += '<tr>';
                    }
                    
                    $('#landdetils tbody').append(addrows);
                }
            });
        });

        $(document).on('click', '.singlelandSales', function() {
            const id = $(this).data('id');
            $('#singleLandCheck-'+id).prop('checked', true);
        })
    });
</script>
@endpush
