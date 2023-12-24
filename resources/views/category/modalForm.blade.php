
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="deleteExpenseId" tabindex="-1" role="dialog" aria-labelledby="deleteExpenseItemId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Are you sure want to delete this item?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="formName">
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="editExpenseId" tabindex="-1" role="dialog" aria-labelledby="editExpenseItemId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-lg">
                <h5 class="modal-title text-danger">Edit Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="editFormTag">
                
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).on('click', '.editExpenseItem', function () {  
            let link = $(this).data('link');
            $.ajax({
                type: "GET",
                url: link,
                success: function (response) {
                    $('#editFormTag').html(response);    
                }
            });
        })

        $(document).on('submit', '#onSubmit', function(event) {
            event.preventDefault(); // Prevent default form submission
            let link = $(this).data('link');
            var formData = $('#onSubmit').serialize(); // Serialize form data
            $.ajax({
                type: "PUT",
                url: link,
                data: formData,
                success: function (response) {
                    toastr.success(response.message);
                    var dataTable = $('#expenseitem-table').DataTable();
                    $('#editExpenseId').modal('hide');
                    dataTable.clear().draw();
                    dataTable.ajax.reload();
                },
                error: function (response) {
                    toastr.error(response.responseJSON.message);
                },
            });
        });

        $(document).on('click', '.deleteExpenseItem', function() {
            let link = $(this).data('link');
            $.ajax({
                type: "GET",
                url: link,
                success: function (response) {
                    $('#formName').html(response);    
                }
            });
        })

        $(document).on('click', '#deleteBtn', function() {
            let action = $(this).data('action');
            $.ajax({
                type: "post",
                url: action,
                data: {
                    "_method" : "delete"
                },
                success: function (response) {
                    console.log('response :>> ', response);
                    if(response.type == 'success') {
                        toastr.success(response.message);
                        var dataTable = $('#expenseitem-table').DataTable();
                        dataTable.clear().draw();
                        dataTable.ajax.reload();
                    }
                    else  toastr.error(response.message);
                    $('#deleteExpenseId').modal('hide');
                },
                error: (response) => $.each(response.responseJSON.errors, (field, messages) => toastr.error(messages))
            });
        })
    </script>
@endpush
