<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct() {
        $this->middleware('permission:role-list', ['only' => ['index', 'edit', 'update']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
    }

    public function index(RoleDataTable $dataTable)//view('home');//view('index');
    {
        $data['page'] = 'index';
        $data['title'] = 'Role';
        return $dataTable->render('home', $data);
    }

    public function edit($id)//view('admin.role.edit')
    {
        $data['role'] = Role::find($id);
        $permissions = Permission::get();
        // $countPermissions = count($data['permissions']) / 2;
        $data['permissions_chunk'] = $permissions->chunk(3);
        $data['rolePermissions'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();
        $data['page'] = 'admin.role.edit';
        $data['title'] = 'Permission Edit';
        return view('home', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['permission' => 'required']);
        $role = Role::find($id);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')->with(['message' =>'Updated Successfully', 'alert-type' => 'success']);;
    }
}
