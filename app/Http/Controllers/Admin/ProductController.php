<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductFeature;
use App\Models\ProductGallery;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        // $data['title'] ="Product Index";
        // $data['rows'] = Product::orderBy('id', 'desc')->get();
        $data['title'] ="Product Index";

        $data['categories'] = Category::where('status', 1)->orderBy('name')->get();
        $data['brands'] = Brand::where('status', 1)->orderBy('name')->get();

        $query = Product::orderBy('id', 'desc');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        $data['rows'] = $query->get();

        return view('admin.product.index',$data);
    }

    public function create()
    {

        $data['title'] ="Product Create";
        $data['brands'] = Brand::where('status', '1')->orderBy('name', 'asc')->get();
        $data['categories'] = Category::where('status', '1')->orderBy('name', 'asc')->get();
        return view('admin.product.create',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'short_description' => 'required',
            'discount' => 'nullable|numeric|min:0|max:100',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:30',
        ]);

        DB::beginTransaction();

        try {
            $rows                    = new Product();
            $rows->title             = $request->title;
            $rows->slug              = Str::slug($request->title);
            $rows->category_id       = $request->category_id;
            $rows->brand_id          = $request->brand_id;
            $rows->short_description = $request->short_description;
            $rows->aditional_info    = $request->aditional_info;
            $rows->description       = $request->description;
            $rows->price             = $request->price;
            $rows->discount          = $request->discount;
            $rows->stock             = $request->stock;
            $rows->status            = $request->status;
            $rows->is_trending       = $request->is_trending;
            $rows->new_arraivals     = $request->new_arraivals;

            // Handle Thumbnail Upload
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
                $thumbnail->move(public_path('uploads/products'), $thumbnailName);
                $rows->thumbnail = 'uploads/products/' . $thumbnailName;
            }
            $rows->save();

            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    // Store each image the same way you are doing for the thumbnail
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads/products/gallery'), $imageName);

                    $productImage = new ProductGallery();
                    $productImage->product_id = $rows->id;
                    $productImage->image = 'uploads/products/gallery/' . $imageName;
                    $productImage->save();
                }
            }

            if ($request->has('features')) {
                foreach ($request->features as $feature) {
                    // Ensure each feature is not more than 15 characters
                    $productFeature = new ProductFeature();
                    $productFeature->product_id = $rows->id;
                    $productFeature->feature = $feature;
                    $productFeature->save();

                }
            }

            DB::commit();

            Toastr::success(trans('Product Added Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.product.index');

        } catch (\Exception $e) {

            DB::rollBack();
            // dd($e);

            Toastr::error(trans('Product not Added!'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.product.index');
        }
    }

    public function edit($id){

        $data['title'] ="Product Edit";
        $data['product'] =  Product::find($id);
        $data['brands'] = Brand::where('status', '1')->orderBy('name', 'asc')->get();
        $data['categories'] = Category::where('status', '1')->orderBy('name', 'asc')->get();
        return view('admin.product.edit',$data);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:0,1',
            'is_trending' => 'nullable|in:0,1',
            'new_arraivals' => 'nullable|in:0,1',
            'short_description' => 'required',
            'description' => 'nullable',
            'aditional_info' => 'nullable',
            'thumbnail' => 'nullable',
            'images' => 'nullable|array',
            'images.*' => 'nullable',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:30',
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);


        DB::beginTransaction();
        try {

            // Update the product details
            $product->title = $request->title;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->price = $request->price;
            $product->discount = $request->discount;
            $product->stock = $request->stock;
            $product->status = $request->status;
            $product->is_trending = $request->is_trending;
            $product->new_arraivals = $request->new_arraivals;
            $product->short_description = $request->short_description;
            $product->description = $request->description;
            $product->aditional_info = $request->aditional_info;

            // Handle Thumbnail Image
            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail
                if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
                    File::delete(public_path($product->thumbnail));
                }
                // Save new thumbnail

                $thumbnail = $request->file('thumbnail');
                $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
                $thumbnail->move(public_path('uploads/products'), $thumbnailName);
                $product->thumbnail = 'uploads/products/' . $thumbnailName;
            }
            $product->save();



            if (isset($request->preloaded_removed)) {
                $preloaded_removed = $request->preloaded_removed;
                $unmatched_images = [];

                foreach ($preloaded_removed as $image) {
                    $img = ProductGallery::where('id', $image)->first();
                    $image_url = $img->image;
                    $unmatched_images[] = ltrim(str_replace(url('/'), '', $image_url), '/');
                }

                // Fetch current images from the database
                $current_images = $product->images->pluck('image')->toArray();

                // Get remaining images (not deleted ones)
                $remaining_images = array_diff($current_images, $unmatched_images);

                // Delete removed images from storage and database
                foreach ($unmatched_images as $image_path) {
                    $gallery = ProductGallery::where('image', $image_path)->first();
                    if ($gallery) {
                        if (File::exists(public_path($image_path))) {
                            File::delete(public_path($image_path));
                        }
                        $gallery->delete();
                    }
                }
            }


            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads/products/gallery'), $imageName);

                    $productImage = new ProductGallery();
                    $productImage->product_id = $product->id;
                    $productImage->image = 'uploads/products/gallery/' . $imageName;
                    $productImage->save();
                }
            }

            // Store new product features if provided
            if ($request->has('features')) {
                $features = array_filter($request->features, function ($feature) {
                    return !is_null($feature) && $feature !== ''; // Remove null or empty values
                    dd($request->features);
                });
                if (!empty($features)) { // Proceed only if valid features exist
                    $product->feature()->delete();

                    foreach ($features as $feature) {
                        $productFeature = new ProductFeature();
                        $productFeature->product_id = $product->id;
                        $productFeature->feature = $feature;
                        $productFeature->save();
                    }
                }
            }


            DB::commit();

            Toastr::success(trans('Product updated successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            // Redirect back with success message
            return redirect()->route('admin.product.index');

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
            Toastr::error(trans('Product not Added!'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.product.index');
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $product = Product::findOrFail($id);

            if ($product->orderDetails()->exists()) {
                DB::rollBack();
                Toastr::error(trans('Cannot delete product. It is associated with an order.'), 'Error', ["positionClass" => "toast-top-center"]);
                return redirect()->route('admin.product.index');
            }


            if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
                unlink(public_path($product->thumbnail));
            }
            $product->feature()->delete();
            $product->images()->delete();
            $product->delete();
            DB::commit();

            // Redirect back with success message
            Toastr::success(trans('Product deleted successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.product.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error(trans('An error occurred while deleting the product.'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.product.index');
        }
    }


    public function Show($id){

        $data['title'] ="Product Details";
        $data['product'] = Product::find($id);
        return view('admin.product.view',$data);
    }

    public function gallery($id = null){

        $data['title'] ="Product Details";

        return view('admin.product.gallery',$data);
    }
}
