$(function () {
    
    var timeoutId = null;
    var currentHost = (location.pathname.includes('real-state')) ? location.origin+ '/real-state' : location.origin;    
    // if(location.pathname.includes('edit') && location.pathname.includes('withdraw')) userDetails('#withdraw_details', 'withdraw');
    // For New Customer Create
    $(document).on('click', '#customersave', function() {
        $.ajax({
            url: $('#customersave').data('url'),
            method: 'POST',
            data: $("#onCustomerForm").serialize(), 
            success: function(response) {
                $('#customerModel').modal('hide');
                toastr.success('Customer Created Successfully.');
                $('#customer_details_phone').val(response.customer.phone);
                // return userDetails('#customer_details');
                $('#customerInfo').html(response.view);
            },
            error: (response) => $.each(response.responseJSON.errors, (field, messages) => toastr.error(messages))
        })
    })
    
    $('#customer_details_phone').on('input', () => { 
        clearTimeout(timeoutId);
        timeoutId = setTimeout(function() {
            const value = $(`#customer_details_phone`).val();
            $.ajax({
                type: "GET",
                url: currentHost+'/customer-search',
                data: { query: value },
                success: function (response) {
                    console.log('response :>> ', response);
                    const users = response.users;
                    $(`#customer_list`).empty();
                    $('#customerInfo').html('');
                    let phone = $('#customer_details_phone').val();
                    if(users.length < 1) {
                        toastr.warning('No Customer found!');
                    } else if(users.length>1) {
                        if(phone.includes('+') || phone.includes('0') || phone.includes('01')) {
                            users.map((option) => {
                                $(`#customer_details_list`).append(`<option class="details" value="${option.phone}">Name: ${option.name}, Id(${option.account_id})</option>`); 
                            });
                        } else {
                            users.map((option) => {
                                $(`#customer_details_list`).append(`<option class="details" value="${option.account_id}">Name: ${option.name}, Phone: ${option.phone}</option>`); 
                            });
                        }
                    } else {
                        const phonevalue = (users[0].phone.includes(phone)) ? users[0].phone : users[0].account_id;
                        $(`#customer_details_phone`).val(phonevalue);
                        $('#customerInfo').html(response.view);
                    }
                }, 
                error: function (response) {
                    toastr.error(response.responseJSON.message);
                }
            });
        }, 500);
    }); //For Customer Information

    if(location.pathname.includes('edit')) {
        $('#user_details_phone').on('input', () => {return userDetails('#user_details', 'saleEdit') }); //For agent Information
    } else {
        $('#user_details_phone').on('input', () => {return userDetails('#user_details', 'saleCreate') }); //For agent Information
    }
    $('#withdraw_details_phone').on('input', () => {return userDetails('#withdraw_details', 'withdraw') }); //For withdraw user Information

    function userDetails(id, type = null) {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(function() {
            const role = $(`${id}_phone`).data('user');
            const value = $(`${id}_phone`).val();
            $.ajax({
                type: "GET",
                url: currentHost+'/search-user',
                data: { user: role, query: value, type: type },
                success: function (response) {
                    console.log('response :>> ', response);
                    const users = response.users;
                    $(`${id}_list`).empty();
                    $('#'+role+'Info').html('');
                    let phone = $(`${id}_phone`).val();
                    if(users.length < 1) {
                        toastr.warning('No User found!');
                    } else if(users.length>1) {
                        
                        if(phone.includes('+') || phone.includes('0') || phone.includes('01')) {
                            users.map((option) => {
                                let role = (option.role == 3) ? 'Master Agent' : 'Agent';
                                let account_id = (option.account_id == null) ? 'Name: '+ option.name : 'Account No: ' + option.account_id;
                                $(`${id}_list`).append('<option class="details" value="' + option.phone + '">'+account_id+'(Role: '+role+')</option>')
                            });
                        } else {
                            users.map((option) => {
                                let role = (option.role == 3) ? 'Master Agent' : 'Agent';
                                $(`${id}_list`).append('<option class="details" value="' + option.account_id + '">Contact no: '+option.phone+'(Role: '+role+')</option>')
                            });
                        }
                    } else {
                        const phonevalue = (users[0].phone.includes(phone)) ? users[0].phone : users[0].account_id;
                        $(`${id}_phone`).val(phonevalue);
                        $('#'+role+'Info').html(response.view);
                    }
                }, 
                error: function (response) {
                    toastr.error(response.responseJSON.message);
                }
            });
        }, 500);
    }
});