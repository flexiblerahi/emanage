<style>
    .select2-results__option:hover{
        background-color: #3875d7 !important; 
        color:white !important;
    }
</style>
@include('modules.backbutton')
<div id="parentoptions">
    @include('expenseItem.options', ['expenseItems' => $expenseItems])
</div>
<div id="otheroptions">
</div>
<!-- Modal -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="onSubmit" method="post">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="title_x">Title</label>
                            <input type="text" class="form-control" required name="title_x" id="title_x" placeholder="Please Enter the title.">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(function () {
            $(document).on('change', '.suboptions', function () {
                var value = $(this).val();
                var id = $(this).attr('id');
                if(value != '') {
                    $.ajax({
                        type: "GET",
                        url: "{{route('expense-item.submenu')}}",
                        data: {
                            "id" : value 
                        },
                        success: function (response) {
                            console.log('response :>> ', response);
                            toastr.success('Expense types found Successfully');
                            $('#'+id).attr("disabled", true);
                            $('#otheroptions').append(response.view);
                            $('#remove-'+value).data('parentSelect', id);
                            $('#optiontitle_'+value).select2();
                            $('[id^="remove"]').addClass('d-none');
                            // Show the last element
                            $('[id^="remove"]').last().removeClass('d-none');
                        }
                    });
                }
            });
            ////
            $(document).on('click', '.addnewbtn', function () {
                let modalform = $('#addnew').html();
                modalform = modalform.replace(/title_\w{1,4}/g, "title_"+ $(this).data('parent'));
                $('#addnew').html(modalform);
            });

            $(document).on('click', '.removebtn', function () {
                $('#'+$(this).data('parentSelect')).attr("disabled", false);
                $('#options-'+$(this).data('parent')).remove();
                if(location.pathname.includes('pos')) $('#expense_item_id').val(null);

                $('[id^="remove"]').addClass('d-none');
  
                // Show the last element
                $('[id^="remove"]').last().removeClass('d-none');
            });

            $(document).on('submit', '#onSubmit', function(event) {
                event.preventDefault(); // Prevent default form submission
                var formData = $('#onSubmit').serialize(); // Serialize form data
                $.ajax({
                    type: "post",
                    url: "{{route('expense-item.store')}}",
                    data: formData,
                    success: function (response) {
                        toastr.success(response.message);
                        let expenseItem = response.expenseItem;
                        let select = $('#optiontitle_0');
                        if(expenseItem.parent != null) select = $('#optiontitle_'+ expenseItem.parent);
                        var newOption = new Option(expenseItem.title, expenseItem.id);
                        select.append(newOption);
                        select.trigger('change');
                        $('#addnew').modal('hide');
                    },
                    error: function (response) {
                        toastr.error(response.responseJSON.message);
                    }
                });
            });
            ////
        });    
    </script>
@endpush