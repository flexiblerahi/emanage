<?php

namespace App\Http\Controllers;

use App\DataTables\AgentDataTable;
use App\Models\Role;
use App\Models\UserDetail;
use App\Rules\UniquePhoneForRole;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function __construct() {
        $this->middleware('permission:agent-list|agent-view|new-agent|agent-edit', ['only' => ['index', 'show', 'edit', 'updatestatus', 'update', 'store', 'create']]);
        $this->middleware('permission:agent-edit', ['only' => ['edit', 'update', 'updatestatus']]);
        $this->middleware('permission:new-agent', ['only' => ['store', 'create']]);
        $this->middleware('permission:agent-view', ['only' => ['show']]);
    }

    public function index(AgentDataTable $agentDataTable) //view('index') view('report.modalform') view('modules.modal')
    {
        $data['page'] = 'index';
        $data['title'] = 'Agents List';
        if(auth()->user()->can('agent-view')) {
            $data['modal'] = 'modules.modal';
            $data['modal_title'] = 'Agent Detail';
            $data['modal_type'] = 'agent';
        }
        return $agentDataTable->render('home', $data);
    }

    public function show($id) //view('accountant.show') //view('customer.show') //view('shareholder.show') //view('agent.show')
    {
        if(request()->ajax()) {
            $data['agent'] = UserDetail::find($id);
            return view('agent.show', $data)->render();
        } return abort(404);
    }

    public function create() //view('agent.create')
    {
        $data['page'] = 'agent.create';
        $data['title'] = 'New Agent';
        return view('home', $data);
    }

    public function edit(string $id) //view('agent.edit')
    {
        $data['agent'] = UserDetail::findorfail($id);
        $agentId = $data['agentId'] = explode(',', $data['agent']->reference_id);
        $data['sh_agent'] = UserDetail::query()->where('id', $agentId[0])->select('id', 'role', 'name', 'phone', 'account_id')->first();
        $data['page'] = 'agent.edit';
        $data['title'] = 'Agent Details Edit';
        return view('home', $data);
    }

    public function update(Request $request, $id) { return $this->upstore($request, $id); }

    public function store(Request $request) { return $this->upstore($request); }

    public function validation($request, $id, $roles)
    {   
        $validate['name'] = ['required','string','max:255'];
        $validate['phone'] = [ 'required', new UniquePhoneForRole($roles['id'], $roles['name'], $id) ];
        $validate['account_id'] = ['nullable'];
        $validate['present_address'] = ['required'];
        $validate['permanent_address'] = ['required'];
        $validate['father'] = ['required','string','max:255'];
        $validate['mother'] = ['required','string','max:255'];
        $validate['reference_id'] = ['required'];
        $validate['emergency_contact'] = ['nullable'];
        $validate['occupation'] = ['nullable'];
        $validate['father'] = ['nullable'];
        $validate['mother'] = ['nullable'];
        $validate['image'] = ['nullable'];
        return $request->validate($validate, ['reference_id' => 'Reference Agent or Master Agent must be required.']);
    }

    private function upstore($request, $id = null)
    {
        $userId = $request->input('reference_id');
        $refernceId = UserDetail::where('id', $userId)->first();
        if(!$refernceId) {
            if(request()->ajax()) return response()->json(['message' => 'Refrence Id Does Not Exist'], 404);
            return redirect()->back()->with(['message' => 'Refrence Id Does Not Exist', 'alert-type' => 'error']);
        }
        $role = Role::findorfail(4)->toArray(); // agent = 4;
        $input = $this->validation($request, $id, $role);
        if(is_null($id)) {
            $user_detail = new UserDetail();
            $user_detail->role = $role['id'];
            $user_detail->image = (key_exists('image', $input)) ? uploadFile($input['image'], autoIdGenerator('user_details', true), "/profile/") : null;
        } else {
            $user_detail = UserDetail::findorfail($id);
            $user_detail->image = (key_exists('image', $input)) ? uploadFile($input['image'], $user_detail->id, '/profile/', $user_detail->image) : null;
        }
        $user_detail->refer_id = $userId;
        $user_detail->reference_id = $userId.','.$refernceId->reference_id;
        $user_detail->name = $input['name'];
        $user_detail->phone = $input['phone'];
        $user_detail->present_address = $input['present_address'];
        $user_detail->permanent_address = $input['permanent_address'];
        $user_detail->emergency_contact =  $input['emergency_contact'];
        $user_detail->occupation = $input['occupation'];
        $user_detail->parent_name = json_encode(['father' => $input['father'], 'mother' => $input['mother']]);
        $user_detail->account_id = $request->input('account_id');
        $user_detail['status'] = ($request->status == 'on') ? 1 : 0;
        $user_detail->save();
        $msg = is_null($id) ? 'New Agent Created Successfully' : 'Agent Updated Successfully';
        return redirect()->route('agent.index')->with(['message' => $msg, 'alert-type' => 'success']);
    }
}
