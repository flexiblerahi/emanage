
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="createBrandId" tabindex="-1" role="dialog" aria-labelledby="createBrandTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Brand Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body" id="formName">
                @include('brand.create')
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).on('click', '.editbrand', function() {
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
                url: "{{route('brand.create')}}",
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
                    if ($('#brand-table').length) {
                        var dataTable = $('#brand-table').DataTable();
                        dataTable.clear().draw();
                        dataTable.ajax.reload();
                    } else {
                        var select = $('#brand_id');
                        var newOption = new Option(response.brand.name, response.brand.id);
                        select.append(newOption);
                        select.trigger('change');                        
                    }
                    $('#createBrandId').modal('hide');

                },
                error: (response) => $.each(response.responseJSON.errors, (field, messages) => toastr.error(messages))
            });
        })
    </script>
@endpush
