<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeeDataTable;
use App\Models\Role;
use App\Models\UserDetail;
use App\Rules\UniquePhoneForRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(EmployeeDataTable $employeeDataTable) {
        $data['page'] = 'index';   
        $data['title'] = 'Stuff list';
        $data['modal'] = 'modules.modal';
        $data['modal_title'] = 'Employee Detail';
        $data['modal_type'] = 'employee';
        $data['modalbodyClass'] = 'p-0';
        $employeeDataTable->setModaltype($data['modal_type']);
        return $employeeDataTable->render('home', $data);
    }

    public function create() { // view('employee.create')
        $data['title'] = 'New Stuff';
        $data['page'] = 'employee.create';
        return view('home', $data);
    }

    public function show(string $id) { // view('employee.show')
        if(request()->ajax()) {
            $data['employee'] = UserDetail::findorfail($id);
            return view('employee.show', $data)->render();
        } else abort(404);       
    }

    public function edit(string $id) { // view('employee.edit')
        $data['employee'] = UserDetail::findorfail($id);
        $data['title'] = 'Edit Stuff Profile';
        $data['page'] = 'employee.edit';
        return view('home', $data);
    }

    public function store(Request $request) { return $this->upstore($request); }

    public function update(Request $request, string $id) { return $this->upstore($request, $id); }

    public function upstore($request, $id = null) {
        $role = Role::findorfail(7)->toArray();
        $input = $this->validation($request, $id, $role);
        if(is_null($id)) {
            $user_detail = new UserDetail();
            $user_detail->image = (key_exists('image', $input)) ? uploadFile($request->image, autoIdGenerator('user_details', true), "/profile/") : null;
            $user_detail->role = 7; //employee role id 7 from roles table
        } else {
            $user_detail = UserDetail::findorfail($id);
            $user_detail->image = (key_exists('image', $input)) ? uploadFile($request->image, $user_detail->id, '/profile/', $user_detail->image) : null;
        }
        $user_detail->account_id = $input['account_id'];
        $user_detail->name = $input['name']; 
        $user_detail->phone = $input['phone']; 
        $user_detail->present_address = $input['present_address']; 
        $user_detail->permanent_address = $input['permanent_address']; 
        $user_detail->emergency_contact = $input['emergency_contact']; 
        $user_detail->occupation = $input['occupation']; 
        $user_detail->parent_name = json_encode(['father' => $input['father'], 'mother' => $input['mother']]);
        $user_detail->status = key_exists('status', $input) ? 1 : 0;
        $user_detail->save();
        $msg = is_null($id) ? 'Stuff Created Successfully' : 'Stuff Update Successfully';
        return to_route('employee.index')->with(['message' => $msg, 'alert-type' => 'success']);
    }

    public function validation($request, $id, $roles) {
        $validate['name'] = ['required','string','max:255'];
        $validate['account_id'] = ['nullable'];
        $validate['phone'] = [ 'required', new UniquePhoneForRole($roles['id'], $roles['name'], $id) ];
        $validate['status'] = ['nullable'];
        $validate['emergency_contact'] = ['nullable'];
        $validate['image'] = ['nullable'];
        $validate['occupation'] = ['nullable'];
        $validate['present_address'] = ['required'];
        $validate['permanent_address'] = ['required'];
        $validate['father'] = ['required','string','max:255'];
        $validate['mother'] = ['required','string','max:255'];
        return $request->validate($validate);
    }

    public function search(Request $request) {
        $input = $request->all();
        $data['users'] = array();
        if(is_null($input['query'])) return response()->json($data);
        $query = $input['query'];
        // $data['users'] = UserDetail::filterusers($input['query'], UserDetail::queryroles('employee')); // Illuminate\Database\Eloquent\Builder::filterusers 252 lines
        $data['users'] = $users = UserDetail::query()->whereIn('role', UserDetail::queryroles('employee'))->where(function ($search) use ($query) {
            $search->where('account_id', 'like', '%' . $query . '%')
                ->orWhere('phone', 'like', $query . '%');
        })->select('id', 'role', 'name', 'phone', 'account_id', 'status')->get();
        if(count($data['users']) == 1) {
            $data['user'] = UserDetail::with('user')->find($data['users'][0]->id);
            $data['view'] = view('salary.userInfo', $data)->render();
        }
        return response()->json($data);
    }
}