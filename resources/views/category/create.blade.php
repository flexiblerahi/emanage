<style>
    .select2-results__option:hover{
        background-color: #3875d7 !important; 
        color:white !important;
    }
</style>
@include('modules.backbutton')
<div id="parentoptions">
    @include('category.options', ['categories' => $categories])
</div>
<div id="otheroptions">
</div>
<!-- Modal -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="modelNameId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-name">New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-window-close h1" aria-hidden="true"></i>

                </button>
            </div>
            <form id="onSubmit" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name_x">Name</label>
                        <input type="text" class="form-control" required name="name_x" id="name_x" placeholder="Please Enter the name.">
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
                        url: "{{route('category.submenu')}}",
                        data: {
                            "id" : value 
                        },
                        success: function (response) {
                            toastr.success('Category types found Successfully');
                            $('#'+id).attr("disabled", true);
                            $('#otheroptions').append(response.view);
                            $('#remove-'+value).data('parentSelect', id);
                            $('#optionname_'+value).select2();
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
                modalform = modalform.replace(/name_\w{1,4}/g, "name_"+ $(this).data('parent'));
                $('#addnew').html(modalform);
            });

            $(document).on('click', '.removebtn', function () {
                $('#'+$(this).data('parentSelect')).attr("disabled", false);
                $('#options-'+$(this).data('parent')).remove();
                if(location.pathname.includes('pos')) $('#category_id').val(null);

                $('[id^="remove"]').addClass('d-none');
  
                // Show the last element
                $('[id^="remove"]').last().removeClass('d-none');
            });

            $(document).on('submit', '#onSubmit', function(event) {
                event.preventDefault(); // Prevent default form submission
                var formData = $('#onSubmit').serialize(); // Serialize form data
                $.ajax({
                    type: "post",
                    url: "{{route('category.store')}}",
                    data: formData,
                    success: function (response) {
                        toastr.success(response.message);
                        let category = response.category;
                        let select = $('#optionname_0');
                        if(category.parent != null) select = $('#optionname_'+ category.parent);
                        var newOption = new Option(category.name, category.id);
                        select.append(newOption);
                        select.trigger('change');
                        $('#addnew').modal('hide');
                        $('.modal-backdrop').remove();
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