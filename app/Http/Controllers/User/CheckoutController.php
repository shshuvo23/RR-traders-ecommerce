<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $setting                = getSetting();
        $data['title']          = 'Checkout';
        $data['og_title']       = 'Checkout';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        $data['stripe_enable']  = $setting->stripe_enable;
        $data['total']          = $request->total;
        $data['user']           = auth()->user();
        $data['cartItems']      = Session::get('cart', []);
        $data['coupon']         = Session::get('applied_coupon', null);
        $data['countries']      = Country::OrderBy('name', 'asc')->get();
        // dd($data['coupon'] );
        // Session::forget('applied_coupon');

        return view('frontend.checkout', $data);
    }


    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('code', strtoupper($request->coupon_code))->first();

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid coupon code.']);
        }

         // Check if the coupon has expired
        if ($coupon->expiry_date && now()->gt($coupon->expiry_date)) {
            return response()->json(['success' => false, 'message' => 'Coupon has expired.']);
        }

        // Check if the coupon's used count is 0 (i.e., the coupon can still be applied)
        if ($coupon->used_count == 0) {
            return response()->json(['success' => false, 'message' => 'Coupon has already been used and cannot be applied.']);
        }

        // Check if the coupon's status is active (status = 1)
        if ($coupon->status != 1) {
            return response()->json(['success' => false, 'message' => 'Coupon is not active.']);
        }



        $subtotal = $request->subtotal;

        if ($coupon->discount_type == 'percentage') {
            $discount = ($coupon->discount / 100) * $subtotal;
        } elseif ($coupon->discount_type == 'fixed') {
            $discount = $coupon->discount;
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid discount type.']);
        }

        $newTotal = max(0, $subtotal - $discount);

        session()->put('applied_coupon', [
            'coupon_id'  => $coupon->id,
            'coupon_code' => $coupon->code,
            'discount' => $discount,
            'discount_type' => $coupon->discount_type,
        ]);

        return response()->json([
            'success' => true,
            'discount' => $discount,
            'new_total' => $newTotal,
            'message' => 'Coupon applied successfully!'
        ]);
    }

    public function removeCoupon(Request $request)
    {
        if (session()->has('applied_coupon')) {
            $coupon = session()->get('applied_coupon');
            $originalTotal = session()->get('cart_total'); // Store original total before coupon

            // Remove coupon from session
            session()->forget('applied_coupon');

            return response()->json([
                'success' => true,
                'message' => 'Coupon removed successfully.',
                'original_total' => $originalTotal, // Send original total back
            ]);
        }

        return response()->json(['success' => false, 'message' => 'No coupon found.']);
    }

    public function getStates($countryId)
    {
        $country = Country::findOrFail($countryId);
        $states = Region::where('country_id', $countryId)->get();
        $tax_rate = $country->tax_rate;

        return response()->json([
            'states' => $states,
            'tax_rate' => $tax_rate
        ]);
    }

    public function getShippingFee($stateId)
    {
        $state = Region::findOrFail($stateId);

        // Return the shipping fee for the selected state
        return response()->json([
            'shipping_fee' => $state->shipping_fee
        ]);
    }


}
