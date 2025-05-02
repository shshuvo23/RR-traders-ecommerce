<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CategoriesController extends Controller
{
    public function index()
    {
        $data['title']   = 'Category List';
        $data['rows'] = Category::orderBy('id', 'desc')->get();
        return view('admin.category.index', $data);
    }

    public function create()
    {
        $data['title']   = 'Category create';
        return view('admin.category.create', $data);
    }


    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_home' => 'nullable|boolean',
            'is_highlighted' => 'nullable|boolean',
            'status' => 'required|boolean',
            'orderby' => 'nullable|integer',
        ]);

        // dd($request->all());

        try {
            // Handle file upload
            if ($request->hasFile('category_image')) {
                $image = $request->file('category_image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/categories'), $imageName);
                $imagePath = 'uploads/categories/' . $imageName;
            } else {
                $imagePath = null;
            }

            // Create new category
            $row = new Category();
            $row->name = $request->name;
            $row->slug = Str::slug($request->name);
            $row->category_image = $imagePath;
            $row->is_home = $request->is_home ?? 0;
            $row->is_highlighted = $request->is_highlighted ?? 0;
            $row->status = $request->status;
            $row->orderby = $request->orderby ?? Category::max('orderby') + 1;
            $row->save();


            Toastr::success(trans('Category Created Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.category.index');
        } catch (\Exception $e) {
            Toastr::error(trans('Category not Updated !'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.category.index');
        }
    }


    public function edit($id)
    {
        $data['title']   = 'Category Edit';

        $data['category'] = Category::find($id);

        return view('admin.category.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_home' => 'nullable|boolean',
            'is_highlighted' => 'nullable|boolean',
            'status' => 'required|boolean',
            'orderby' => 'nullable|integer',
        ]);

        try {
            // Find the existing category
            $row = Category::findOrFail($id);

            // Handle file upload
            if ($request->hasFile('category_image')) {
                $image = $request->file('category_image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/categories'), $imageName);
                $imagePath = 'uploads/categories/' . $imageName;

                // Delete old image if exists
                if ($row->category_image && file_exists(public_path($row->category_image))) {
                    unlink(public_path($row->category_image));
                }

                $row->category_image = $imagePath;
            }

            // Update category details
            $row->name = $request->name;
            $row->slug = Str::slug($request->name);
            $row->is_home = $request->is_home;
            $row->is_highlighted = $request->is_highlighted;
            $row->status = $request->status;
            $row->orderby = $request->orderby;
            $row->save();

            Toastr::success(trans('Category Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.category.index');
        } catch (\Exception $e) {
            Toastr::error(trans('Category not Updated!'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.category.index');
        }
    }


    public function show($id)
    {
        $data['title']   = 'Category Details';

        $data['row'] = Category::find($id);
        return view('admin.category.view', $data);
    }

    public function delete($id)
    {
        try {
            // Find the category by ID
            $row = Category::findOrFail($id);

            if ($row->products()->exists()) { // Assuming the relationship is named 'products'
                Toastr::error(trans('Category cannot be deleted as it has associated products.'), 'Error', ["positionClass" => "toast-top-center"]);
                return redirect()->route('admin.category.index');
            }

            // Delete the category image if it exists
            if ($row->category_image && file_exists(public_path($row->category_image))) {
                unlink(public_path($row->category_image));
            }

            // Delete the category
            $row->delete();

            Toastr::success(trans('Category Deleted Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.category.index');
        } catch (\Exception $e) {
            Toastr::error(trans('Category not Deleted!'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.category.index');
        }
    }
}
