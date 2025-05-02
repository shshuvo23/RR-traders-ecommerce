<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $data['title'] = "Slider List";
        $data['rows'] = Slider::orderBy('id', 'desc')->get();
        return view('admin.slider.index', $data);
    }

    public function create()
    {

        $data['title'] = "Slider Create";

        return view('admin.slider.create', $data);
    }



    public function store(Request $request)
    {
        try {

            $request->validate([
                'name'          => 'required|string|max:255',
                'image'         => 'required',
                'link'          => 'nullable|url',
                'sorting_order' => 'required|integer',
                'status'        => 'required|in:0,1',
            ]);

            $slider = new Slider();
            $slider->name           = $request->name;
            $slider->link           = $request->link;
            $slider->sorting_order  = $request->sorting_order ? $request->sorting_order : Slider::max('sorting_order') + 1;
            $slider->status         = $request->status;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/sliders'), $imageName);
                $imagePath = 'uploads/sliders/' . $imageName;
                $slider->image = $imagePath;
            }

            $slider->save();

            Toastr::success(trans('Slider Created Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.slider.index');
        } catch (\Exception $e) {

            Toastr::error(trans('Slider not Created!'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.slider.index');
        }
    }




    public function edit($id)
    {

        $data['title'] = "Slider Create";

        $data['slider'] = Slider::find($id);

        return view('admin.slider.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the input data
            $request->validate([
                'name'          => 'required|string|max:255',
                'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'link'          => 'nullable|url',
                'sorting_order' => 'required|integer',
                'status'        => 'required|in:0,1',
            ]);

            $slider = Slider::findOrFail($id);

            // Update the slider details
            $slider->name           = $request->name;
            $slider->link           = $request->link;
            $slider->sorting_order  = $request->sorting_order;
            $slider->status         = $request->status;

            if ($request->hasFile('image')) {
                if (file_exists(public_path($slider->image))) {
                    File::delete(public_path($slider->image));
                    // unlink(public_path($slider->image));
                }

                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/sliders'), $imageName);
                $imagePath = 'uploads/sliders/' . $imageName;
                $slider->image = $imagePath;
            }

            $slider->save();
            Toastr::success(trans('Slider Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.slider.index');
        } catch (\Exception $e) {
            Toastr::error(trans('Slider not Updated!'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.slider.index');
        }
    }

    public function delete($id)
    {
        try {

            $row = Slider::findOrFail($id);

            if ($row->slider_image && file_exists(public_path($row->slider_image))) {
                File::delete(public_path($row->slider_image));
            }
            $row->delete();

            Toastr::success(trans('Slider Deleted Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.slider.index');
        } catch (\Exception $e) {
            Toastr::error(trans('Slider not Deleted!'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.slider.index');
        }
    }

    public function show($id)
    {

        $data['title'] = "Slider Create";

        $data['row'] = Slider::find($id);

        return view('admin.slider.view', $data);
    }
}
