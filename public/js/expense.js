$(function () {
    var timeoutId = null;
    var currentHost = (location.pathname.includes('real-state')) ? location.origin+ '/real-state' : location.origin;

    $('#pay_at').datepicker({ format: "dd/mm/yyyy" });
   
    $(document).on('click', '#onsubmit', function() {
        const formdata = $('#formHandle').serialize();
        $.ajax({
            url: $('#onsubmit').data('url'),
            method: 'POST',
            data: formdata, 
            success: function(response) {
                toastr.success(response.message);
                $('#expense_details_title').val(response.expenseitem.title);
                return expensedetails();
            },
            error: (response) => $.each(response.responseJSON.errors, (field, messages) => toastr.error(messages))
        })
    })

});