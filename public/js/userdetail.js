"use strict";
$(function () { 
    var currentHost = (location.pathname.includes('real-state')) ? location.origin+ '/real-state' : location.origin;
    var timeoutId = null;
    $('#user_details_phone').on('input', function () {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(function() {
            $.ajax({
                type: "GET",
                url: currentHost+'/search-user',
                data: { user: $('#user_details_phone').data('user'), query: $('#user_details_phone').val(), type: $('#user_details_phone').data('user') },
                dataType: "json",
                success: function (response) {
                    $('#referenceDetails').html('');
                    const users = response.users;
                    const phone = $("#user_details_phone").val();
                    $('#user_details_list').empty();
                    if(users.length < 1) {
                        toastr.warning('No User found!');
                        $('.user_detail').val('');
                    } else if(users.length>1) {
                        if(phone.includes('+') || phone.includes('0') || phone.includes('01')) {
                            users.map((option) => {
                                let role = (option.role == 3) ? 'Master Agent' : 'Agent';
                                let account_id = (option.account_id == null) ? 'Name: '+ option.name : 'Account No: ' + option.account_id;
                                $('#user_details_list').append('<option class="details" value="' + option.phone + '">'+account_id+'(Role: '+role+')</option>')
                            });
                        }
                        else {
                            users.map((option) => {
                                let role = (option.role == 3) ? 'Master Agent' : 'Agent';
                                $('#user_details_list').append('<option class="details" value="' + option.account_id + '">Contact no: '+option.phone+'(Role: '+role+')</option>')});
                        }
                    } else {
                        const phonevalue = (users[0].phone.includes(phone)) ? users[0].phone : users[0].account_id;
                        $("#user_details_phone").val(phonevalue);
                        $('#referenceDetails').html(response.view);
                    }
                }
            });
        }, 500);
    });
});

function readupdateprofileimgURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => $('#showImage').attr('src', e.target.result);
        reader.readAsDataURL(input.files[0]);
    }
}