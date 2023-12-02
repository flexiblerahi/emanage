
@push('script')
    <script>
        $(function () {
            var timeoutId = null;
            var currentHost = (location.pathname.includes('real-state')) ? location.origin+ '/real-state' : location.origin;

            $(document).on('input', '#user_details_phone', () => {return userDetails('#user_details') }); //For agent and shareholder Information
            function userDetails(id, type = null) {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(function() {
                    const role = $(`${id}_phone`).data('user');
                    const value = $(`${id}_phone`).val();
                    $.ajax({
                        type: "GET",
                        url: "{{route('report.user.info')}}",
                        data: { user: role, query: value, type: type },
                        success: function (response) {
                            $(`${id}_list`).empty();
                            if(response.users) {
                                const users = response.users;
                                if(users.length < 1) {
                                    toastr.warning('No '+role+' found!');
                                    $('#'+role+'Info').html('');
                                }
                                else users.map( (option) => { 
                                    const phone = $(`${id}_phone`).val();
                                    if(phone.includes('sh') || phone.includes('a') || phone.includes('cu') ) {
                                        $(`${id}_list`).append(`<option class="details" value="${option.account_id}">${option.phone}, Name: (${option.name})</option>`); 
                                    } else $(`${id}_list`).append(`<option class="details" value="${option.phone}">${option.account_id}, Name: (${option.name})</option>`); 
                                });
                            } else $('#'+role+'Info').html(response);
                        }, 
                        error: function (response) {
                            toastr.error(response.responseJSON.message);
                        }
                    });
                }, 500);
            }

            $(document).on('input', '#employee_details_phone', function () {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(function() {
                    $.ajax({
                        type: "GET",
                        url: currentHost+'/employee-search',
                        data: { query: $('#employee_details_phone').val() },
                        dataType: "json",
                        success: function (response) {
                            $('#employeeInfo').html('');
                            const users = response.users;
                            const phone = $("#employee_details_phone").val();
                            $('#employee_details_list').empty();
                            if(users.length < 1) {
                                toastr.warning('No User found!');
                            } else if(users.length>1) {
                                users.map((option) => $('#employee_details_list').append('<option class="details" value="' + option.phone + '">Account No: '+option.account_id+'</option>'));
                            } else {
                                const phonevalue = (users[0].phone.includes(phone)) ? users[0].phone : users[0].account_id;
                                $("#employee_details_phone").val(phonevalue);
                                $('#employeeInfo').html(response.view);
                            }
                        }
                    });
                }, 500);
            });
            
            
        });

        
    </script>
@endpush