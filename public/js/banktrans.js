$(function () {
    var timeoutId = null;
    var currentHost = (location.pathname.includes('real-state')) ? location.origin+ '/real-state' : location.origin;
    $(document).on('change', '#bank_type', () => { return bankDetails($('#bank_type :selected').val()) });
    $(document).on('change', '#account_number', () => { return bankDetails($('#bank_type :selected').val(), $('#account_number :selected').val()) });

    function bankDetails(bankname, account_number = null) {
        clearTimeout(timeoutId);
        // if(bankname != '1') {
            $.ajax({
                type: "GET",
                url: currentHost+'/search_bank',
                data: { 
                    'bank_name_id': bankname,
                    'id': account_number
                },
                success: function (response) {
                     $('#account_number').empty();
                    const banks = response.banks;

                    $('#trx_num').attr("disabled", false);
                    $('#trx_by').attr("disabled", false);
                    $('#account_number').attr("disabled", false);
                    if(banks.length < 1) {
                        $('#account_number').append($('<option>').val('').text('Select Account Number').trigger('change'));
                        toastr.warning('No Bank Information found!');
                        $('#bankInfo').html('');
                    } else if(banks.length > 1) {
                        toastr.success('Bank Accounts Found. Please check on List!');
                        $('#account_number').append($('<option>').val('').text('Select Account Number').trigger('change'));
                        // if(account_number == null) {
                            // $('#account_number').empty()
                            banks.map((bank) => {
                                $('#account_number').append($('<option>').val(bank.id).text(bank.account_id));
                            })
                        // }
                    } else {
                        banks.map(bank => {
                            $('#account_number').append($('<option>').val(bank.id).text(bank.account_id).trigger('change'));
                        })
                        $('#bankInfo').html('');
                        $('#bankInfo').html(response.view);
                        if(response.bank_info.bank_name_id == 1) {
                            $('#trx_num').attr("disabled", true);
                            $('#trx_by').attr("disabled", true);
                            $('#account_number').attr("disabled", true);
                        }
                    }
                }, 
                error: function (response) {
                    toastr.error(response.responseJSON.message);
                }
            });
        // }
    } 
});