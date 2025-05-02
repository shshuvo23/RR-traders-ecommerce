<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function wishlist()
    {
        $setting = getSetting();
        $data['title']          = 'Wishlist';
        $data['og_title']       = 'Wishlist';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image']       = $setting->site_logo;
        $data['meta_keywords']  = $setting->seo_keywords;
        $data['wishlists']      = Wishlist::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();

        return view('frontend.wishlist', $data);
    }


    public function addToWishlist(Request $request)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Please log in to add products to your wishlist.',
                ]);
            }

            $productId = $request->product_id;

            // Check if the product already exists in the user's wishlist
            $existingWishlistItem = Wishlist::where('user_id', $user->id)
                                            ->where('product_id', $productId)
                                            ->first();

            if ($existingWishlistItem) {
                // Optionally, you can remove it from the wishlist
                // $existingWishlistItem->delete();
                return response()->json(['status' => 'removed', 'message' => 'This product is already in your wishlist.']);
            } else {
                // Add the product to the wishlist
                $wishlist = new Wishlist();
                $wishlist->user_id = $user->id;
                $wishlist->product_id = $productId;
                $wishlist->save();

                $wishlistCount = Wishlist::where('user_id', $user->id)->count();

                return response()->json([
                    'status' => 'added',
                    'message' => 'Product added to wishlist',
                    'wishlistCount' => $wishlistCount
                ]);

            }
        } catch (\Exception $e) {
            // dd($e);
            // Return a generic error message
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.',
            ]);
        }
    }

    public function removeFromWishlist($product_id)
    {
        // Assuming you have a method to remove the product from the wishlist
        $wishlistItem = Wishlist::where('user_id', auth()->user()->id)->where('product_id', $product_id)->first();

        try {
            if ($wishlistItem) {
                $wishlistItem->delete();

                $wishlistCount = Wishlist::where('user_id', auth()->user()->id)->count();

                return response()->json([
                    'status' => "removed",
                    'message' => "Item removed from wishlist",
                    'wishlistCount' => $wishlistCount // Send updated count
                ]);
            }

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'error', 'message' => 'Product not found']);
        }

    }
}
