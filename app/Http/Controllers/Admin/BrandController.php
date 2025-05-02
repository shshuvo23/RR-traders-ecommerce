<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
class BrandController extends Controller
{

    public function index(){

        $data['title'] = " Brand Index";
        $data['rows'] = Brand::orderBy('id', 'desc')->get();
        return view('admin.brand.index',$data);
       }

       public function create(){

          $data['title'] = " Brand Create";

          return view('admin.brand.create',$data);
         }


         public function edit($id){

          $data['title'] = " Brand Edit";
          $data['brand'] = Brand::find($id);
          return view('admin.brand.edit',$data);
         }


         public function show($id){

          $data['title'] = " Brand Details";
          $data['row'] = Brand::find($id);

          return view('admin.brand.show ',$data);
         }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
            'status' => 'required|boolean',
        ]);

        try {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->slug = Str::slug($request->name);
            $brand->status = $request->status;
            $brand->save();

            Toastr::success(trans('Brand Created Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.brand.index');
        } catch (\Exception $e) {
            Toastr::error(trans('Brand Not Created!'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.brand.index');
        }
    }

        public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $id,
            'status' => 'required|boolean',
        ]);

        try {
            $brand = Brand::findOrFail($id);
            $brand->name = $request->name;
            $brand->slug = Str::slug($request->name);
            $brand->status = $request->status;
            $brand->save();

            Toastr::success(trans('Brand Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.brand.index');
        } catch (\Exception $e) {
            Toastr::error(trans('Brand Not Updated!'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.brand.index');
        }
    }

    public function delete($id){

        try {
            $brand = Brand::findOrFail($id);
            $brand->delete();

            Toastr::success(trans('Brand Deleted Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.brand.index');
        } catch (\Exception $e) {
            Toastr::error(trans('Brand Not Deleted!'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.brand.index');
        }

    }

}
