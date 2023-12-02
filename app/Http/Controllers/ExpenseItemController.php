<?php

namespace App\Http\Controllers;

use App\DataTables\ExpenseItemDataTable;
use App\Models\BackupExpenseItem;
use App\Models\ExpenseItem;
use Exception;
use Illuminate\Http\Request;

class ExpenseItemController extends Controller
{
    public function __construct() {
        $this->middleware('permission:expense-type-list|new-expense-type|expense-type-edit|expense-type-view|expense-type-delete', ['only' => ['index', 'create', 'store', 'edit', 'update', 'show', 'deleteForm', 'destroy']]);
        $this->middleware('permission:new-expense-type', ['only' => ['create', 'store']]);
        $this->middleware('permission:expense-type-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:expense-type-view', ['only' => ['show']]);
        $this->middleware('permission:expense-type-delete', ['deleteForm', 'destroy']);
    }

    public function index(ExpenseItemDataTable $expenseItemDataTable) {//view('index') //view('modules.modal') //view('expenseItem.modalForm')
        $data = [ 'page' => 'index', 'title' => 'Expense Types' ];
        if(auth()->user()->can('expense-type-view')) {
            $data['modal'] = 'modules.modal';
            $data['modalForm'] = 'expenseItem.modalForm';
            $data['modal_type'] = 'expenseItem';
            $data['modal_title'] = 'Expese Type Details';
            $data['modalbodyClass'] = 'p-0';
            $expenseItemDataTable->setModaltype($data['modal_type']);
        }
        return $expenseItemDataTable->render('home', $data);
    }

    public function show(string $id) { //view('expenseItem.show')
        if(request()->ajax()) {
            $data['expenseItem'] = ExpenseItem::with('entrier')->findorfail($id);
            return view('expenseItem.show', $data)->render();
        } else abort(404);
    }

    public function create() { //view('expenseItem.create')
        $data = ['title' => 'New Expense Type', 'page' => 'expenseItem.create'];
        $data['expenseItems'] = ExpenseItem::query()->whereNull('parent')->get(['id', 'title']);
        return view('home', $data);
    }

    public function edit(string $id) { 
        $data['title'] = 'Edit Expense Type';
        $data['expenseItem'] = ExpenseItem::findorfail($id);    
        return view('expenseItem.edit', $data)->render();
    }

    public function update(Request $request, ExpenseItem $expenseItem) { 
        $input = $request->validate(['title' => ['required', 'unique:expense_items,title,'.$expenseItem->id], 'comment' => ['required']]);
        try {
            BackupExpenseItem::store($expenseItem, $input['comment']);
            $expenseItem->title = $input['title'];
            $expenseItem->entry = entry();
            $expenseItem->save();
        } catch(Exception $e) {
            return response()->json(['message' => 'Something Wrong. Please try Contact Developer!', 'alert-type' => 'error'], 503);
        }
        
        return response()->json(['message' => 'Updated Successfully', 'alery-type' => 'success']);
    }

    public function store(Request $request) { 
        $rules = array();
        foreach($request->all() as $key => $value) {
            if(str_contains($key, 'title')) {
                $title = explode('_',$key);
                $rules[$key] = ['required', 'unique:expense_items,title'];
            }
        }

        $request->validate($rules, ['unique' => 'Title Already Exist.']);
        $expenseItem = new ExpenseItem();
        $expenseItem->title = $value;
        $expenseItem->parent = ($title[1] == '0') ? null : $title[1];
        $expenseItem->entry = entry();
        $expenseItem->save();
        return response()->json(['message' => 'Created Successfully.', 'expenseItem' => $expenseItem]);
    }

    public function submenu(Request $request) {
        $data['parent'] = $expenseItem = ExpenseItem::with('expenseItems')->find($request->get('id'));
        $data['expenseItems'] = $expenseItem->expenseItems;
        $data['edit'] = ($request->input('edit')) ? true : false;
        $data['view'] = view('expenseItem.options', $data)->render();
        return response()->json($data);
    }

    public function deleteForm(ExpenseItem $expenseItem) {
        return view('expenseItem.delete', compact('expenseItem'))->render();
    }

    public function destroy(string $id) {
        $expenseItem = ExpenseItem::with('expenses')->findOrFail($id);
        $submenus = ExpenseItem::where('parent', $id)->get(['id']);
        if((count($submenus) < 1) && (count($expenseItem->expenses) < 1)) {
            $expenseItem->delete();
            return response()->json(['message' => 'Delete Successfully', 'type' => 'success']);
        } else if(count($submenus) > 0) {
            return response()->json(['message' => "Can't Delete Because it has already submenus!", 'type' => 'error']);
        }
        return response()->json(['message' => "Can't Delete Because it has already expenses!", 'type' => 'error']);
    }
}