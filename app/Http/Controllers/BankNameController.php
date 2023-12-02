<?php

namespace App\Http\Controllers;

use App\DataTables\BankNameDataTable;
use App\Models\BankName;
use Illuminate\Http\Request;

class BankNameController extends Controller
{
    public function __construct() {
        if(!(request()->ajax()) && !(request()->routeIs('bank-name.index'))) abort(404);
    }

    public function index(BankNameDataTable $bankNameDataTable) //view('index') //view('bankName.modalForm')
    {
        $data['page'] = 'index';
        $data['title'] = 'All Bank Names';
        $data['modalForm'] = 'bankName.modalForm';
        $data['modal'] = 'modules.modal';
        $data['modal_type'] = 'bankName';
        $data['modal_title'] = 'Bank Name Details';
        $bankNameDataTable->setModaltype($data['modal_type']);
        return $bankNameDataTable->render('home', $data);
    }
    
    public function show($id)
    {
        $data['bankName'] = BankName::findorfail($id);
        return view('bankName.show', $data)->render();
    }

    public function create()
    {
        return view('bankName.create')->render();
    }

    public function store(Request $request)
    {
        $request->validate(['name' => ['required', 'unique:bank_names,name']]);
        $bankName = $this->upstore($request, new BankName());
        return response()->json(['message' => 'Bank Name Create Successfully', 'bankName' => $bankName]);
    }

    public function edit($id)
    {
        $data['bankName'] = BankName::findorfail($id);
        return view('bankName.create', $data)->render();
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => ['required', 'unique:bank_names,name,'. $id]]);
        $bankName = BankName::findorfail($id);
        $this->upstore($request, $bankName);
        return response()->json(['message' => 'Bank Name Updated Successfully']);
    }

    public function upstore($request, $bankName)
    { 
        $bankName->name = $request->input('name');
        $bankName->status = isStatus($request->input('status'));
        $bankName->entry = entry();
        $bankName->save();
        return $bankName;
    }
}