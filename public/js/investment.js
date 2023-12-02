$(function () {
    var timeoutId = null;
    var currentHost = (location.pathname.includes('real-state')) ? location.origin+ '/real-state' : location.origin;
    
    $('#investor_details_phone').on('input', () => { return userDetails('#investor_details') }); //For Investor Information
    
    $('#invest_at').datepicker({ format: "dd/mm/yyyy" });

    $('#invest_at').on('change', function () {
        let duration = $('#duration').val();
        if(duration == '' || duration == '0') toastr.error('Please fillup duration number first.');
        else return getEndDate(duration);
    })

    $('#duration').on('input', function () {
        let duration = $('#duration').val();
        if(parseInt(duration) > 0) return getEndDate(duration);
    })

    $('#duration_in').on('change', function () {
        let duration = $('#duration').val();
        if(parseInt(duration) > 0) return getEndDate(duration);
    })

    function getEndDate(duration) {
        const startDate = moment(formatdate());
        const durationIn = $('#duration_in :selected').val();
        const endDate = moment(startDate).add(parseInt(duration), durationIn);
        $('#endDate').text(endDate.format('DD/MM/YYYY'));
        $('#mature_date').removeClass('d-none')
    }

    function formatdate() {
        const dateString = $('#invest_at').val();
        const [day, month, year] = dateString.split("/");
        const dateObject = new Date(`${year}-${month}-${day}`);
        return dateObject;``
    }

    function userDetails(id) {
        $('#investorInfo').html('');
        clearTimeout(timeoutId);
        timeoutId = setTimeout(function() {
            const role = $(`${id}_phone`).data('user');
            const value = $(`${id}_phone`).val();
            $.ajax({
                type: "GET",
                url: currentHost+'/search-investor',
                data: { query: value },
                success: function (response) {
                    $(`${id}_list`).empty();
                    if(response.users) {
                        const users = response.users;
                        if(users.length < 1) {
                            toastr.warning('No '+role+' found!');
                            $('#'+role+'Info').html('');
                        }
                        else users.map( (option) => {
                            $(`${id}_list`).append(`<option class="details" value="${option.account_id}">Phone: ${option.phone}</option>`); 
                        });
                    } else {
                        if(response.investor.account_id.includes($(`${id}_phone`).val())) {
                            $(`${id}_phone`).val(response.investor.account_id);
                        } else $(`${id}_phone`).val(response.investor.phone);
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