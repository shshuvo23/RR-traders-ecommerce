@extends('frontend.layouts.app')

@section('title')
{{ $title ?? '' }}
@endsection

@section('meta')
    <meta property="og:title" content="{{ $seo->title ?? $og_title }}" />
    <meta property="og:description" content="{{ $seo->description ?? $og_description }}" />
    <meta property="og:image" content="{{ asset($seo->image ?? $og_image) }}" />
    <meta name="description" content="{{$seo->meta_description ?? $og_description}}">
    <meta name="keywords" content="{{$seo->keywords ?? $meta_keywords}}">
@endsection
@push('style')
@endpush
@php
    $localLanguage = Session::get('languageName');
@endphp
@section('content')
    <!-- ======================= breadcrumb start  ============================ -->
    @section('breadcrumb')
        <li class="breadcrumb-item"> {{$title}}</li>
    @endsection
    <!-- ======================= breadcrumb end  ============================ -->

    <div class="page-content pt-2 pb-2">
        <div class="container">
            @if ($wishlists->count() > 0)
                <table class="table table-wishlist table-mobile">
                    <thead>
                        <tr>
                            <th width="25%">Product</th>
                            <th width="10%">Price</th>
                            <th width="10%"></th>
                            <th width="5%"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($wishlists as $wishlist)
                            <tr>
                                <td class="product-col">
                                    <div class="product">
                                        <figure class="product-media">
                                            <a href="{{route('productDetails', $wishlist->product->slug)}}">
                                                <img src="{{asset($wishlist->product->thumbnail)}}"
                                                    alt="Product image">
                                            </a>
                                        </figure>

                                        <h3 class="product-title">
                                            <a href="{{route('productDetails', $wishlist->product->slug)}}">{{$wishlist->product->title}}</a>
                                        </h3>
                                    </div>
                                </td>
                                <td class="price-col">
                                    @php
                                        $discountPrice = $wishlist->product->price - ($wishlist->product->price * $wishlist->product->discount) / 100;
                                    @endphp

                                    @if ($wishlist->product->discount && $wishlist->product->discount > 0)
                                        <span class="new-price">${{ number_format($discountPrice, 2) }}</span>
                                        <span class="old-price">${{ number_format($wishlist->product->price, 2) }}</span>
                                    @else
                                        <span class="new-price">${{ number_format($discountPrice, 2) }}</span>
                                    @endif
                                </td>
                                <td class="action-col text-right">
                                    <a href="javascript:void(0)" data-id="{{ $wishlist->product->id }}"  class="btn btn-outline-primary-2 open-offcanvas addToCart"><i
                                        class="icon-cart-plus"></i>Add to Cart</a>
                                </td>
                                <td class="remove-col">
                                    <button class="btn btn-danger remove-item" data-id="{{ $wishlist->product->id }}"><i class="icon-close"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
            <div class="text-center pt-5 pb-5 mt-5 mb-5">
                <h3>
                    No products in your wishlist
                </h3>
            </div>
            @endif
        </div>
    </div>

@endsection

@push('script')
    <script>
        $(document).ready(function () {
            // Handle click event for remove button
            $(".table-wishlist").on("click", ".remove-item", function () {
                let button = $(this);
                let row = button.closest("tr"); // Get the row to remove it later
                let productId = button.data("id"); // Get product ID from the remove button's data-id attribute

                $.ajax({
                    url: "{{ route('user.remove.wishlist', ':product_id') }}".replace(':product_id', productId), // Insert product_id into URL
                    method: "GET", // Change to GET request
                    success: function (response) {
                        if (response.status === "removed") {
                            // toastr.success(response.message);

                            // Remove the row from the wishlist table
                            row.remove();

                            // Update Wishlist Count
                            $(".wishlist-count").text(response.wishlistCount);
                        } else {
                            toastr.error(response.message, "Error");
                        }
                    },
                    error: function () {
                        toastr.error("Something went wrong!");
                    }
                });
            });
        });

    </script>
@endpush
