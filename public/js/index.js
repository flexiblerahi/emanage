"use strict";
//update status 
$(function () { 
    $(document).on('click', '.onstatus', function() {
        let url= $(this).data('url')+'&status='+($(this).data('status') == 0 ? 1 : 0);
        return changeStatus($(this).attr('id'), url);
    });

    $(document).on('change', '.custom-switch-input', function() {
        let url= $(this).data('url')+'&status='+(($(this).prop('checked')) ? 1 : 0);
        return changeStatus($(this).data('id'), url);
    })

    function changeStatus(id, url) {
        $.ajax({
            type: "get",
            url: url,
            dataType: "json",
            success: function (response) {
                toastr.success(response.message);
                if (response.status == 0) {
                    $('#'+ id).text('Deactive');
                    $('#'+ id).data('status', 0);
                } else {
                    $('#'+ id).text('Active');
                    $('#'+ id).data('status', 1);
                  }
                // $('#'+ id).toggleClass('btn-success btn-secondary');
                var dataTable = $('#userdetails-table').DataTable();
                dataTable.clear().draw();
                dataTable.ajax.reload();
            }
        });
    }

    $(document).on('click', '.commission', function () {
        $("#commissionId").modal();
        $.ajax({
            type: "get",
            url: $(this).data('link'),
            dataType: "json",
            success: function (response) {
                $('.modal-title').text('Total: '+response.total);
                let rank = 1;
                $('#commission-rank-table tbody').children('tr').empty();
                while(rank<4) {
                    let hand = 1;
                    let newRow = '<tr>';
                    newRow += '<td scope="row">Rank '+rank+'</td>';
                    while(hand<4) {
                        newRow += '<td>'+response['rank'+rank]['hand'+hand]+'</td>';
                        hand++;
                    }
                    newRow += '<td>'+response['rank'+rank]['shareholder']+'</td>';
                    newRow += '</tr>';
                    rank++
                    $('#commission-rank-table').append(newRow);
                } 
            }
        });
    });

    $(document).on('click', '.showmodal', function () {
        $("#"+$(this).data('role')+"Id").modal();
        $.ajax({
            type: "get",
            url: $(this).data('link'),
            success: function (response) {
            $('.modal-body').html(response);
            }
        });
    });
})