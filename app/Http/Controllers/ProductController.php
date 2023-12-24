<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(ProductDataTable $productDataTable) {
        $data['page'] = 'index';   
        $data['title'] = 'Product list';
        $data['modal'] = 'modules.modal';
        $data['modal_title'] = 'Product Detail';
        $data['modal_type'] = 'product';
        $data['modalbodyClass'] = 'p-0';
        // $productDataTable->setModaltype($data['modal_type']);
        return $productDataTable->render('home', $data);
    }

    public function create() { // view('product.create')
        $data['title'] = 'New Stuff';
        $columns = array('id', 'name');
        $data['brands'] = Brand::query()->select($columns)->get();
        $data['page'] = 'product.create';
        return view('home', $data);
    }

    public function show(string $id) { // view('product.show')
        if(request()->ajax()) {
            $data['product'] = Product::findorfail($id);
            return view('product.show', $data)->render();
        } else abort(404);       
    }

    public function edit(string $id) { // view('product.edit')
        $data['product'] = Product::findorfail($id);
        $data['title'] = 'Edit Stuff Profile';
        $data['page'] = 'product.edit';
        return view('home', $data);
    }

    public function store(Request $request) { return $this->upstore($request); }

    public function update(Request $request, string $id) { return $this->upstore($request, $id); }

    public function upstore($request, $id = null) {
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
        return to_route('product.index')->with(['message' => $msg, 'alert-type' => 'success']);
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
        // $data['users'] = UserDetail::filterusers($input['query'], UserDetail::queryroles('product')); // Illuminate\Database\Eloquent\Builder::filterusers 252 lines
        $data['users'] = $users = UserDetail::query()->whereIn('role', UserDetail::queryroles('product'))->where(function ($search) use ($query) {
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
