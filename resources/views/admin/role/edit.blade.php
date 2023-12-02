<style>
    .form-check {
        cursor: pointer;
    }
    .pointer {
        cursor: pointer;
    }
    .item-hover:hover {
        background-color: #4e73df;
        color: whitesmoke;
    }
</style>
{!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-3">
                <h4 for="inputName"><span class="font-weight-bold">Role Name: </span>{{$role->name}}</h4>
            </div>
            <hr>
        </div>
        
        <div class="container col-lg-12">
            <div class="mb-3">
                <div class="form-group">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4 border rounded py-3 mt-1 mb-3 item-hover shadow-sm">
                                <div class="form-check">
                                    <input type="checkbox" name="checkall" id="checkall" class="form-check-input" onClick="check_uncheck_checkbox();" />
                                    <h5 class="form-check-label" id="allchecked">All permissions</h5>
                                </div>
                            </div>
                        </div>
                        
                        @foreach ($permissions_chunk as $permissions)
                            <div class="row my-1">
                                @foreach ($permissions as $value)                                
                                    <div class="col border rounded py-3 mx-1 item-hover shadow-sm">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input pointer" name="permission[]" id="{{$value->id}}" value="{{$value->id}}" @checked(in_array($value->id, $rolePermissions))
                                            onClick="this.checked">
                                            <h5 class="form-check-label permissionschecked" for="{{ $value->id }}">
                                                {{ str_replace("-", " ", ucwords($value->name, "-")) }}
                                            </h5>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 text-center">
            <div class="mb-3">
                <button type="submit" class="btn btn-primary btn-block" role="button">Submit</button>
            </div>
        </div>
    </div>
{!! Form::close() !!}
@push('script')
    <script>
        $(function () {
            $('.permissionschecked').on('click', function () {  
                console.log('$(this) :>> ', $(this).attr('for'));
                $('#'+$(this).attr('for') ).prop('checked', function(_, checked) {
                    return !checked;
                });
            })
            $('#allchecked').on('click', function() {
                $('#checkall' ).prop('checked', function(_, checked) {
                    return !checked;
                });
                return check_uncheck_checkbox();
            })
            
            // $('input[name="permission[]"]').on("click", function() {
            //     if ($(this).is(":not(:checked)"))
            //         $('#checkall').prop('checked', false);
            // });
        });

        function check_uncheck_checkbox() {
                const isChecked = $('#checkall');
                console.log('is :>> ', isChecked.prop('checked'));
                if (isChecked.prop('checked')) {
                    $('input[name="permission[]"]').each(function() {
                        this.checked = true;
                    });
                } else {
                    $('input[name="permission[]"]').each(function() {
                        this.checked = false;
                    });
                }
            }
    </script>
@endpush

