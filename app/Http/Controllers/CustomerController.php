<?php

namespace App\Http\Controllers;

use App\DataTables\CustomerDataTable;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(CustomerDataTable $customerDataTable) {
        $data['page'] = 'index';
        $data['title'] = 'Customer';
        $data['modal'] = 'modules.modal';
        $data['modal_title'] = 'Customer Detail';
        $data['modal_type'] = 'customer';
        return $customerDataTable->render('home', $data);
    }

    public function show(string $id) {
        if(request()->ajax()) {
            $data['customer'] = Customer::find($id);
            return view('customer.show', $data)->render();
        } return abort(404);
    }

    public function create() { //view('customer.create')
        $data['page'] = 'customer.create';
        $data['title'] = 'New Customer';
        return view('home', $data);
    }

    public function edit(string $id) {//view('customer.edit')
        $data['customer'] = Customer::findorfail($id);
        $data['page'] = 'customer.edit';
        $data['title'] = 'Customer Details Edit';
        return view('home', $data);
    }

    public function update(Request $request, $id) { return $this->upstore($request, $id); }

    public function store(Request $request) { return $this->upstore($request); }

    private function upstore($request, $id = null)
    {
        $input = $this->validation($request, $id);
        if(is_null($id)) {
            $customer = new Customer;
            if(key_exists('image', $input)) $customer->image = uploadFile($input['image'], autoIdGenerator('customers', true, false, true), '/profile/customer/');
        } else {
            $customer = Customer::findorfail($id);
            if(key_exists('image', $input)) $customer->image = uploadFile($input['image'], $customer->id, '/profile/customer/', $customer->image);
        }
        $customer->account_id = $input['account_id'];
        $customer->name = $input['name'];
        $customer->phone = $input['phone'];
        $customer->present_address = $input['present_address'];
        $customer->permanent_address = $input['permanent_address'];
        $customer->emergency_contact =  $input['emergency_contact'];
        $customer->occupation = $request->input('occupation');
        $customer->parent_name = json_encode(['father' => $input['father'], 'mother' => $input['mother']]);
        if(request()->ajax()) $customer->status = 1;
        else $customer->status = key_exists('status', $input) ? 1 : 0;
        $customer->entry = entry();
        $customer->save();
        if(request()->ajax()) {
            $view = view('sale.customerInfo', ['user' => $customer])->render();
            return response()->json(['customer' => $customer, 'view' => $view, 'message' => 'Customer Created Successfully'], 200);
        }
        $msg = (is_null($id)) ?  'Customer Created Successfully' : 'Customer Updated Successfully';
        return redirect()->route('customer.index')->with(['message' => $msg, 'alert-type' => 'success']);
    }

    public function validation($request, $id = null)
    {
        $validate['name'] = ['required','string','max:255'];
        $validate['account_id'] = is_null($id) ?  ['unique:customers,account_id'] : ['unique:customers,account_id,'. $id];
        $validate['image'] = ['nullable'];
        $validate['phone'] = ['required'];
        $validate['present_address'] = ['required'];
        $validate['permanent_address'] = ['required'];
        $validate['emergency_contact'] = ['nullable'];
        $validate['father'] = ['required','string','max:255'];
        $validate['mother'] = ['required','string','max:255'];
        $validate['status'] = ['nullable'];
        return $request->validate($validate);
    }

    public function search(Request $request)
    { 
        $data['users'] = array();
        $query = $request->input('query');
        if(is_null($query)) return response()->json($data);
        $customers = Customer::query();
        $data['users'] = $customers->where(function ($search) use ($query) {
            $search->where('account_id', 'like', '%' . $query . '%')
                ->orWhere('phone', 'like', $query . '%');
        })->select('id', 'name', 'phone', 'account_id', 'status')->get();
        if(count($data['users']) == 1) {
            $data['user'] = Customer::find($data['users'][0]->id);
            $data['view'] = view('sale.customerInfo', $data)->render();
        }
        return response()->json($data);
    }
}
