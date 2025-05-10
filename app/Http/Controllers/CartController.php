<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function carts()
    {
        // Session::forget('cart');
        // dd(Session::get('cart'));
        $setting = getSetting();
        $data['title']          = 'Carts';
        $data['og_title']       = 'Carts';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        // $data['cartItems'] = Session::get('cart', []);
        $cartItems = Session::get('cart', []);

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $data['cartItems'] = $cartItems;
        $data['subtotal'] = $subtotal;

        return view('frontend.carts', $data);
    }


    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Product not found']);
        }

        $cart = Session::get('cart', []);

        // dd($request->all(),$cart);
        if (isset($cart[$product->id])) {
            // dd($cart[$product->id]);
            $cart[$product->id]['quantity'] += 1;
        } else {
            // dd('new');
            $cart[$product->id] = [
                'product_id' => $product->id,
                'slug'       => $product->slug,
                'title'      => $product->title,
                'price'      => $product->discount > 0
                                ? number_format($product->price - ($product->price * $product->discount / 100), 2, '.', '')
                                : number_format($product->price, 2, '.', ''),
                'quantity'   => $request->quantity,
                'discount'   => $product->discount,
                'stock'      => $product->stock,
                'thumbnail'  => asset($product->thumbnail),
            ];
        }

        Session::put('cart', $cart);
        $cartCount = count($cart);

        return response()->json([
            'status'    => 'success',
            'message'   => 'Item added to cart successfully!',
            'cartCount' => $cartCount,
            'cartItems' => $cart,
        ]);

    }

    public function updateQuantity(Request $request)
    {
        try {
            $cart = Session::get('cart', []);
            $productId = $request->product_id;
            $newQuantity = $request->quantity;

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] = $newQuantity;
                Session::put('cart', $cart);
            }

            // Recalculate subtotal
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Quantity updated successfully!',
                'subtotal' => number_format($subtotal, 2),
                'total' => number_format($cart[$productId]['price'] * $newQuantity, 2)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong! Please try again.'
            ], 500);
        }
    }


    public function removeFromCart(Request $request, $id)
    {
        try {
            // Retrieve cart from session
            $cart = Session::get('cart', []);

            if (empty($cart)) {
                Toastr::warning('Your cart is already empty!', 'Warning');
                return redirect()->back();
            }

            $cart = array_filter($cart, function ($item) use ($id) {
                return $item['product_id'] != $id;
            });

            Session::put('cart', $cart);

            Toastr::success('Item removed from cart!', 'Success');
            return redirect()->back();

        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again!', 'Error');
            return redirect()->back();
        }

    }
}
