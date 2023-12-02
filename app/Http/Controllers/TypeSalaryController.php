<?php

namespace App\Http\Controllers;

use App\DataTables\SalaryTypeDataTable;
use App\Models\SalaryType;
use Illuminate\Http\Request;

class TypeSalaryController extends Controller
{
    public function __construct() {
        $this->middleware('permission:salary-type-list|new-salary-type|salary-type-edit|salary-type-delete', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy', 'deleteForm']]);
        $this->middleware('permission:new-salary-type', ['only' => ['create', 'store']]);
        $this->middleware('permission:salary-type-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:salary-type-delete', ['only' => ['destroy', 'deleteForm']]);
    }

    public function index(SalaryTypeDataTable $salaryTypeDataTable) //view('salaryType.modalForm')
    {
        $data['page'] = 'index';
        $data['title'] = 'Salary Types';
        $data['modalForm'] = 'salaryType.modalForm';
        return $salaryTypeDataTable->render('home', $data);
    }

    public function create() //view('salaryType.create')
    {
        $data['page'] = 'salaryType.create';
        $data['title'] = 'New Salary Type';
        return view('home', $data);
    }

    public function edit(string $id) //view('salaryType.edit')
    {
        $data['salaryType'] = SalaryType::findorfail($id);
        $data['page'] = 'salaryType.edit';
        $data['title'] = 'Edit Salary Type';
        return view('home', $data);
    }

    public function store(Request $request) { return $this->upstore($request, new SalaryType()); }

    public function update(Request $request, SalaryType $salaryType) { return $this->upstore($request, $salaryType); }

    public function upstore($request, $salaryType) {
        $title = isUpdate() ? ['required', 'unique:salary_types,title,'. $salaryType->id] : ['required', 'unique:salary_types,title'];
        $input = $request->validate(['title' => $title, 'status' => 'nullable']);
        $salaryType->title = $input['title'];
        if(request()->ajax()) $salaryType->status = 1;
        else $salaryType->status = key_exists('status', $input) ? 1 : 0;
        $salaryType->entry = entry();
        $salaryType->save();
        $msg = isUpdate() ? 'Salary Type Updated Successfully' : 'Salary Type Created Successfully'; 
        if(request()->ajax()) return response()->json(['message' => $msg, 'salaryType' => $salaryType], 200);
        return to_route('type-salary.index')->with(['message' => $msg, 'alert-type' => 'success']);
    }
    
    public function deleteForm(SalaryType $salaryType) {
        if(request()->ajax()) {
            return view('salaryType.delete', compact('salaryType'))->render();
        } else abort(404);
    }

    public function destroy(string $id) {
        $salaryType = SalaryType::with('salaries')->findOrFail($id);
        if(is_null($salaryType->salaries)) {
            $salaryType->delete();
            return response()->json(['message' => "Delete Successfully!", 'type' => 'success']);
        }
        return response()->json(['message' => "Can't Delete Because it has already expenses!", 'type' => 'error']);
    }
}
