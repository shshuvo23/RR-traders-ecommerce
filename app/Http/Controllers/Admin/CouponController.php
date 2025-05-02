<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class CouponController extends Controller
{
    public function index()
    {
        $data['title']   = 'Coupon List';
        $data['rows'] = Coupon::get();
        return view('admin.coupon.index',$data);
    }

    public function create()
    {
        $data['title']   = 'Coupon create';
        return view('admin.coupon.create',$data);
    }

    public function edit($id)
    {
        $data['title']   = 'Coupon Edit';
        $data['coupon'] = Coupon::find($id);
        return view('admin.coupon.edit',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons,code|max:50',
            'discount' => 'required|numeric|min:1',
            'discount_type' => 'required|in:fixed,percentage',
            'expiry_date' => 'required|date|after_or_equal:today',
            'used_count'=>'required',
            'status' => 'required|boolean',
        ]);

        try {
            $coupon = new Coupon();
            $coupon->code = $request->code;
            $coupon->discount = $request->discount;
            $coupon->discount_type = $request->discount_type;
            $coupon->expiry_date = $request->expiry_date;
            $coupon->used_count  =$request->used_count ;
            $coupon->status = $request->status;
            $coupon->save();

            Toastr::success(trans('Coupon Created Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.coupon.index');
        } catch (\Exception $e) {
            Toastr::error(trans('Coupon not Created!'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.coupon.index');
        }
    }

        public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|unique:coupons,code,' . $id . '|max:50',
            'discount' => 'required|numeric|min:1',
            'discount_type' => 'required|in:fixed,percentage',
            'expiry_date' => 'required|date|after_or_equal:today',
            'used_count' => 'required',
            'status' => 'required|boolean',
        ]);

        try {
            $coupon = Coupon::findOrFail($id);
            $coupon->code = $request->code;
            $coupon->discount = $request->discount;
            $coupon->discount_type = $request->discount_type;
            $coupon->expiry_date = $request->expiry_date;
            $coupon->used_count = $request->used_count;
            $coupon->status = $request->status;
            $coupon->save();

            Toastr::success(trans('Coupon Updated Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.coupon.index');
        } catch (\Exception $e) {
            Toastr::error(trans('Coupon not Updated!'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.coupon.index');
        }
    }
        public function delete($id)
        {
            try {
                $coupon = Coupon::findOrFail($id);
                $coupon->delete();

                Toastr::success(trans('Coupon Deleted Successfully!'), 'Success', ["positionClass" => "toast-top-center"]);
                return redirect()->route('admin.coupon.index');
            } catch (\Exception $e) {
                Toastr::error(trans('Coupon not Deleted!'), 'Error', ["positionClass" => "toast-top-center"]);
                return redirect()->route('admin.coupon.index');
            }
        }


}
