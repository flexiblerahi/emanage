<?php

namespace App\Http\Controllers;

use App\DataTables\BankInfoDataTable;
use App\Models\BackupBankInfo;
use App\Models\BankInfo;
use App\Models\BankName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankInfoController extends Controller
{
    public function __construct() {
        $this->middleware('permission:bank-info-list|new-bank-info|bank-info-edit|bank-info-view', ['only' => ['index', 'create', 'store', 'edit', 'update', 'show']]);
        $this->middleware('permission:new-bank-info', ['only' => ['create', 'store']]);
        $this->middleware('permission:bank-info-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:bank-info-view', ['only' => ['show']]);
    }

    public function index(BankInfoDataTable $bankInfoDataTable) //view('modules.modal') //view('index')
    {
        $data['page'] = 'index';
        $data['title'] = 'Bank Informations';
        if(auth()->user()->can('bank-info-view')) {
            $data['modal'] = 'modules.modal';
            $data['modal_title'] = 'Bank Information Details';
            $data['modal_type'] = 'bankinfo'; //modal type variable must be same name in show() and page name must be same like this.
            $bankInfoDataTable->setModaltype($data['modal_type']);
        }
        return $bankInfoDataTable->render('home', $data);
    }

    public function show($id)  //view('bankinfo.show')
    {
        if(request()->ajax()) {
            $data['bankinfo'] = BankInfo::with('entrier')->findorfail($id);
            return view('bankinfo.show', $data)->render();
        } else abort(404);
    }

    public function create() //view('bankinfo.create')
    {
        $data['title'] = 'New Bank Account';
        $data['page'] = 'bankinfo.create';
        $data['names'] = BankName::where('status', 1)->whereNotIn('id', [1])->get(['id', 'name']);
        return view('home', $data);
    }
    
    public function edit($id) //view('bankinfo.edit')
    {
        $data['bankInfo'] = BankInfo::findorfail($id);
        $data['title'] = 'Edit Bank Information';
        $data['page'] = 'bankinfo.edit';
        $data['bankNames'] = BankName::where('status', 1)->whereNotIn('id', [1])->get(['id', 'name']);
        return view('home', $data);
    }

    public function store(Request $request)
    {
        $validated = $this->validation($request);
        $this->upstore($validated, $request, new BankInfo());
        return redirect()->route('bank-info.index')->with(['message' => 'Bank Information Create Successfully.', 'alert-type' => 'success']);
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validation($request, $id);
        $bank_info = BankInfo::findorfail($id);
        DB::beginTransaction();
        try {
            BackupBankInfo::store($bank_info, $validated['comment']);
            unset($validated['comment']);
            $bank_info = $this->upstore($validated, $request, $bank_info);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();// Something went wrong, rollback the transaction
            return redirect()->back()->with(['message' => 'Error :'.$e, 'alert-type' => 'error']);
        }
        return redirect()->route('bank-info.index')->with(['message' => 'Bank Information Updated Successfully.', 'alert-type' => 'success']);
    }

    public function validation($request, $id = null) 
    {
        $validate['bank_name_id'] = ['required'];
        $validate['address'] = ['required'];
        if(is_null($id)) $validate['account_id'] = ['required', 'unique:bank_infos,account_id'];
        else {
            $validate['account_id'] = ['required', 'unique:bank_infos,account_id,'. $id];
            $validate['comment'] = ['required'];        
        }
        return $request->validate($validate);
    }

    public function upstore($input, $request, $bank_info)
    {
        $input['status'] = isStatus($request->input('status'));
        $input['entry'] = entry();
        $bank_info = setobj($input, $bank_info);
        $bank_info->save();
        return $bank_info;
    }

    public function search_bank(Request $request)
    {
        if(request()->ajax()) {
            $bank_info = BankInfo::query()->where('bank_name_id', $request->get('bank_name_id'));
            if(!is_null($request->get('id'))) $bank_info = $bank_info->where('id', $request->get('id'));
            $data['banks'] = $bank_info = $bank_info->where('status', 1)->get(['id', 'account_id']);
            if(count($bank_info) == 1) {
                $data['bank_info'] = BankInfo::with('bankname:name,id', 'entrier:name,id,phone,account_id')->select('id', 'amount', 'address', 'bank_name_id', 'entry')->find($bank_info->first()->id);
                $data['view'] = view('investment.bankInfo', $data)->render();
            }
            return response()->json($data);
        } else abort(404);
    }
}