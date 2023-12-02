<script>
    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        Swal.fire({
        title: '{{trans("Are you sure")}}',
        text: "{{trans('You wont be able to revert this')}}",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "{{trans('Yes, delete it')}}"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: url,
                success: function (response) {
                    Swal.fire(
                        "{{trans('Deleted')}}",
                        "{{trans('Item has been deleted')}}",
                        "{{trans('success')}}"
                    )
                    .then((result)=>{
                        location.reload()
                    })
                }
            });
        }
    })
});
</script>
