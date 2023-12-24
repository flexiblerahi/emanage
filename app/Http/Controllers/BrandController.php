<?php

namespace App\Http\Controllers;

use App\DataTables\BrandDataTable;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(BrandDataTable $brandDataTable) //view('index') //view('brand.modalForm')
    {
        $data['page'] = 'index';
        $data['title'] = 'All Brands';
        $data['modalForm'] = 'brand.modalForm';
        $data['modal'] = 'modules.modal';
        $data['modal_type'] = 'brand';
        $data['modal_title'] = 'Brand Details';
        $brandDataTable->setModaltype($data['modal_type']);
        return $brandDataTable->render('home', $data);
    }

    public function create()
    {
        return view('brand.create')->render();
    }

    public function store(Request $request)
    {
        $request->validate(['name' => ['required', 'unique:brands,name']]);
        $brand = $this->upstore($request, new Brand());
        return response()->json(['message' => 'Bank Name Create Successfully', 'brand' => $brand]);
    }

    public function show($id)
    {
        $data['brand'] = Brand::findorfail($id);
        return view('brand.show', $data)->render();
    }

    public function edit($id)
    {
        $data['brand'] = Brand::findorfail($id);
        return view('brand.create', $data)->render();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(['name' => ['required', 'unique:brands,name,'. $id]]);
        $brand = Brand::findorfail($id);
        $this->upstore($request, $brand);
        return response()->json(['message' => 'Brand Updated Successfully']);
    }

    public function upstore($request, $brand)
    { 
        $brand->name = $request->input('name');
        $brand->entry = entry();
        $brand->save();
        return $brand;
    }
}
