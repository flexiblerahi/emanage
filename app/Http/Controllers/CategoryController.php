<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $categoryDataTable) //view('category.modalForm')
    {
        $data = [ 'page' => 'index', 'title' => 'Category Types' ];
        $data['modal'] = 'modules.modal';
        $data['modalForm'] = 'category.modalForm';
        $data['modal_type'] = 'category';
        $data['modal_title'] = 'Category Type Details';
        $data['modalbodyClass'] = 'p-0';
        $categoryDataTable->setModaltype($data['modal_type']);
        
        return $categoryDataTable->render('home', $data);
    }

    public function create() //view('category.create')
    {
        $data = ['name' => 'New Category Type', 'page' => 'category.create'];
        $data['categories'] = Category::query()->whereNull('parent')->get(['id', 'name']);
        return view('home', $data);
    }

    public function store(Request $request) {   
        $rules = array();
        foreach($request->all() as $key => $value) {
            if(str_contains($key, 'name')) {
                $name = explode('_',$key);
                $rules[$key] = ['required', 'unique:categories,name'];
            }
        }

        $lastId = Category::query()->latest()->select('id')->first();
        $sku = is_null($lastId) ? 'CAT-01' : 'CAT-0' . ((int) $lastId->id + 1);

        $request->validate($rules, ['unique' => 'Name Already Exist.']);
        try {
            $category = new Category();
            $category->name = $value;
            $category->parent = ($name[1] == '0') ? null : $name[1];
            $category->entry = entry();
            $category->sku = $sku;
            $category->save();
        } catch(Exception $e) {
            Log::error($e);
        }
        return response()->json(['message' => 'Created Successfully.', 'category' => $category]);
    }

    public function show(string $id)
    {
        if(request()->ajax()) {
            $data['category'] = Category::with('entrier')->findorfail($id);
            return view('category.show', $data)->render();
        } else abort(404);
    }

    public function edit(string $id)
    {
        $data['name'] = 'Edit Category Type';
        $data['category'] = Category::findorfail($id);    
        return view('category.edit', $data)->render();
    }

    public function update(Request $request, Category $category) { 
        $input = $request->validate(['name' => ['required', 'unique:categories,name,'.$category->id], 'comment' => ['required']]);
        try {
            $category->name = $input['name'];
            $category->entry = entry();
            $category->save();
        } catch(Exception $e) {
            return response()->json(['message' => 'Something Wrong. Please try Contact Developer!', 'alert-type' => 'error'], 503);
        }
        
        return response()->json(['message' => 'Updated Successfully', 'alery-type' => 'success']);
    }

    

    public function submenu(Request $request) {
        $data['parent'] = $category = Category::with('categories')->find($request->get('id'));
        $data['categories'] = $category->categories;
        $data['edit'] = ($request->input('edit')) ? true : false;
        $data['view'] = view('category.options', $data)->render();
        return response()->json($data);
    }

    public function deleteForm(Category $category) {
        return view('category.delete', compact('category'))->render();
    }

    public function destroy(string $id) {
        $category = Category::with('products')->findOrFail($id);
        $submenus = Category::where('parent', $id)->get(['id']);
        if((count($submenus) < 1) && (count($category->products) < 1)) {
            $category->delete();
            return response()->json(['message' => 'Delete Successfully', 'type' => 'success']);
        } else if(count($submenus) > 0) {
            return response()->json(['message' => "Can't Delete Because it has already submenus!", 'type' => 'error']);
        }
        return response()->json(['message' => "Can't Delete Because it has already categories!", 'type' => 'error']);
    }
}
