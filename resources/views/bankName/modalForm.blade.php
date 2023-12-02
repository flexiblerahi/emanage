
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="createBankId" tabindex="-1" role="dialog" aria-labelledby="createBankTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bank Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body" id="formName">
                @include('bankName.create')
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).on('click', '.editbank', function() {
            $('#formName').html('');
            let link = $(this).data('link');
            $.ajax({
                type: "get",
                url: link,
                success: function (response) {
                    $('#formName').html(response);
                }
            });
        })
        $(document).on('click', '.buttons-create', function() {
            $('#formName').html('');
            $.ajax({
                type: "get",
                url: "{{route('bank-name.create')}}",
                success: function (response) {
                    $('#formName').html(response);
                }
            });
        })
        $(document).on('click', '#submit', function() {
            let action = $(this).data('action');
            $.ajax({
                type: "post",
                url: action,
                data: $('#formSubmit').serialize(),
                success: function (response) {
                    toastr.success(response.message);
                    if ($('#bankname-table').length) {
                        var dataTable = $('#bankname-table').DataTable();
                        dataTable.clear().draw();
                        dataTable.ajax.reload();
                    } else {
                        var select = $('#bank_name_id');
                        var newOption = new Option(response.bankName.name, response.bankName.id);
                        select.append(newOption);
                        select.trigger('change');                        
                    }
                    $('#createBankId').modal('hide');

                },
                error: (response) => $.each(response.responseJSON.errors, (field, messages) => toastr.error(messages))
            });
        })
    </script>
@endpush
