
<form action = {{ route('roles.store') }} method="POST">
    @csrf
    @include('modules.input', ['name' => 'name', 'placeholder' => 'Role Name'])
    @include('modules.checkbox', ['title' => 'Is User', 'name' => 'is_auth', 'text' => 'Yes / No'])
    <button type="submit" class="btn btn-primary" >Create</button>
</form>
