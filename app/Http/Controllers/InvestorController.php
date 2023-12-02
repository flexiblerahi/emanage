<?php

namespace App\Http\Controllers;

use App\DataTables\InvestorDataTable;
use App\Models\Investor;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    public function __construct() {
        $this->middleware('permission:investor-list|new-investor|investor-edit|investor-view', ['only' => ['index', 'create', 'store', 'edit', 'update', 'show']]);
        $this->middleware('permission:new-investor', ['only' => ['create', 'store']]);
        $this->middleware('permission:investor-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:investor-view', ['only' => ['show']]);
    }

    public function index(InvestorDataTable $investorDataTable) //view('investor.create') //view('modules.modal') view('index')
    {
        $data['page'] = 'index';
        $data['title'] = 'Investor';
        if(auth()->user()->can('investor-view')) {
            $data['modal'] = 'modules.modal';
            $data['modal_title'] = $data['title']. ' Profile';
            $data['modal_type'] = 'investor';
            $investorDataTable->setModaltype($data['modal_type']);
        }
        return $investorDataTable->render('home', $data);
    }

    public function show($id)
    {
        if(request()->ajax()) {
            $data['investor'] = Investor::findorfail($id);
            return view('investor.show', $data)->render();
        } else abort(404);
    }

    public function create() //view('investor.create')
    {
        $data['title'] = 'New Investor';
        $data['page'] = 'investor.create';
        return view('home', $data);
    }

    private function validation($request, $id = null)
    {
        $validate['name'] = ['required', 'string', 'max:255'];
        $validate['phone'] =(is_null($id)) ? ['required', 'max:255', 'unique:investors,phone'] : ['required', 'max:255', 'unique:investors,phone,'. $id];
        $validate['present_address'] = ['required'];
        $validate['permanent_address'] = ['required'];
        $validate['father'] = ['required','string','max:255'];
        $validate['mother'] = ['required','string','max:255'];
        $validate['emergency_contact'] = [ 'nullable' ];
        $validate['father'] = [ 'nullable' ];
        $validate['mother'] = [ 'nullable' ];
        $validate['image'] = [ 'nullable' ];
        $validate['occupation'] = [ 'nullable' ];
        $validate['status'] = [ 'nullable' ];
        return $request->validate($validate);
    }

    public function store(Request $request) { return $this->upstore($request); }

    public function update(Request $request, $id) { return $this->upstore($request, $id); }

    private function upstore($request, $id = null)
    {
        $input = $this->validation($request, $id);
        if(is_null($id)) {
            $investor = new Investor();
            $account_id = Investor::latest()->first();
            $investor->account_id = is_null($account_id) ? randomnumbers(0) : randomnumbers($account_id->id);
        }
        else $investor = Investor::findorfail($id);
        $investor->name = $input['name'];
        $investor->phone = $input['phone'];
        $investor->present_address = $input['present_address'];
        $investor->permanent_address = $input['permanent_address'];
        $investor->emergency_contact = $input['emergency_contact'];
        $investor->occupation = $input['occupation'];
        $investor->parent_name = json_encode(['father' => $input['father'], 'mother' => $input['mother']]);
        $investor->status = key_exists('status', $input) ? 1 : 0;
        $investor->role = 6;
        if($request->has('image')) {
            if(is_null($id)) $investor->image = newuploadFile('profile/investor/', $investor->account_id, $input['image']);
            else $investor->image = newuploadFile('profile/investor/', $investor->account_id, $input['image'], $investor->image);
        }
        $investor->reference_id = auth()->id();
        $investor->save();
        $msg = is_null($id) ? 'Investor Profile Create Successfully.' : 'Investor Profile Update Successfully.';
        return redirect()->route('investor.index')->with(['message' => $msg, 'alert-type' => 'success']);
    }

    public function edit($id) //view('investor.edit')
    {
        $data['investor'] = Investor::findorfail($id);
        $data['title'] = 'Edit Investor';
        $data['page'] = 'investor.edit';
        return view('home', $data);
    }

    public function search(Request $request)
    {
        $investors = Investor::query();
        $investors = $investors->where('phone', 'like', $request->get('query'). '%');
        $investors = $investors->orWhere('account_id', 'like', $request->get('query'). '%');
        $investors = $investors->get(['id', 'phone', 'account_id']);
        if(count($investors) == 1) {
            $data['investor'] = Investor::find($investors->first()->id);
            $data['view'] = view('investment.investorInfo', $data)->render();
            return response()->json($data);
        } 
        return response()->json(['users' => $investors]);
    }
}
