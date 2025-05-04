@extends('frontend.layouts.app')

@section('title')
    {{ $title ?? '' }}
@endsection

@section('meta')
    <meta property="og:title" content="{{ $seo->title ?? $og_title }}" />
    <meta property="og:description" content="{{ $seo->description ?? $og_description }}" />
    <meta property="og:image" content="{{ asset($seo->image ?? $og_image) }}" />
    <meta name="description" content="{{ $seo->meta_description ?? $og_description }}">
    <meta name="keywords" content="{{ $seo->keywords ?? $meta_keywords }}">
@endsection
@push('style')
    <style>
        a.active {
            color: #007bff;
            /* Active color */
            font-weight: bold;
            /* Optional: make the active link bold */
        }
    </style>
@endpush
@php
    $localLanguage = Session::get('languageName');
@endphp
@section('content')
    <!-- ======================= breadcrumb start  ============================ -->
@section('breadcrumb')
    <li class="breadcrumb-item"> {{ $title }}</li>
@endsection
<!-- ======================= breadcrumb end  ============================ -->

<div class="page-content pt-2 pb-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-xl-10">
                <div class="toolbox">
                    <div class="toolbox-left">
                        {{-- <div class="toolbox-info">
                                Showing <span>9 of 56</span> Products
                            </div> --}}
                        <div class="toolbox-info">
                            Showing
                            <span>{{ $all_product->firstItem() }}</span>
                            of <span>{{ $all_product->total() }}</span> Products
                        </div>

                    </div>

                    <div class="toolbox-right">
                    <div class="toolbox-right">
                        <div class="toolbox-sort">
                            <label for="sortby">Sort by:</label>
                            <div class="select-custom">
                                <select name="sortby" id="sortby" class="form-control">
                                    <option value="" class="d-none">Sort By</option>
                                    <option value="az" {{ request('sortby') == 'az' ? 'selected' : '' }}>A - Z</option>
                                    <option value="za" {{ request('sortby') == 'za' ? 'selected' : '' }}>Z - A</option>
                                    <option value="price_high_low" {{ request('sortby') == 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="price_low_high" {{ request('sortby') == 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="date" {{ request('sortby') == 'date' ? 'selected' : '' }}>Date</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    </div>
                </div>

                <div class="products mb-3">
                    <div class="row justify-content-center">

                        @forelse ($all_product as $row)
                            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-1">
                                <div class="product product-2 position-relative">
                                    <ul class="listing-items">

                                        {{-- <li>14"</li>
                                        <li>Intel Core i5</li>
                                        <li>16GB RAM</li>
                                        <li>256GB SSD</li>
                                        <li>Win 11</li> --}}
                                        {{-- Max 5 Items --}}

                                        @foreach ($row->feature as $feature)
                                        {{-- @dd() --}}
                                            <li>{{ $feature->feature }}</li>
                                            {{-- Max 5 items, break if more than 5 --}}
                                            @if ($loop->iteration >= 5)
                                                @break
                                            @endif

                                        @endforeach
                                    </ul>
                                    <figure class="product-media">
                                        <div class="product-cat">
                                            <a href="#">{{ $row->category->name ?? '' }}</a>
                                        </div>
                                        <a href="{{ route('productDetails', $row->slug) }}">
                                            <img src="{{ asset($row->thumbnail ?? '') }}" alt="Product image"
                                                class="product-image">
                                        </a>
                                        <!-- <div class="product-action-vertical">
                                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>
                                            </div> -->
                                    </figure>

                                    <div class="product-body px-3 py-0">
                                        <div class="product-action mb-1">
                                            <a href="javascript:void(0)" data-id="{{ $row->id }}"
                                                class="btn-product btn-cart addToCart open-offcanvas" title="Add to cart"><span>add to
                                                    cart</span></a>
                                        </div>

                                        @php
                                            $isInWishlist =
                                                auth()->check() &&
                                                auth()->user()->wishlist->contains('product_id', $row->id);
                                        @endphp
                                        <div class="product-action wishlist mb-2">
                                            <a href="javascript:void(0)" data-id="{{ $row->id }}"
                                                class="btn-product btn-wishlist addToWishlist"
                                                title="Add to Wishlist"><span>
                                                    {{-- <i class="fa-regular fa-heart"></i> add to wishlist</span> --}}
                                                    <i
                                                        class="{{ $isInWishlist ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}"></i>
                                                    <span>
                                                        {{ $isInWishlist ? 'Added to Wishlist' : 'Add to Wishlist' }}
                                                    </span>
                                            </a>
                                        </div>

                                        {{-- <div class="product-action wishlist mb-2">
                                                <a href="#" class="btn-product btn-wishlist" title="Add to cart"><span>add to wishlist</span></a>
                                            </div> --}}
                                        <div class="product-price">
                                            @if ($row->discount && $row->discount > 0)
                                                @php
                                                    $discountPrice = $row->price - ($row->price * $row->discount) / 100;
                                                @endphp
                                                <span class="new-price">
                                                    ${{ number_format($discountPrice, 2) }}
                                                </span>
                                                <span class="old-price">${{ number_format($row->price, 2) }}</span>
                                            @else
                                                <span class="new-price">${{ number_format($row->price, 2) }}</span>
                                            @endif
                                            {{-- <span class="new-price">${{ $row->price ?? ''}}</span>
                                                <sup> <span class="old-price">${{ $row->discount ?? '' }}</span> </sup> --}}
                                        </div>
                                        <h3 class="product-title"><a
                                                href="{{ route('productDetails', $row->slug) }}">{{ $row->title }}</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No Data Found</p>
                        @endforelse
                    </div>
                </div>

                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">

                        <li class="page-item active" aria-current="page">
                            {{ $all_product->links() }}
                        </li>

                    </ul>
                </nav>
            </div>
            <aside class="col-lg-3 col-xl-2 order-lg-first">
                <div class="sidebar sidebar-shop">
                    <div class="widget widget-clean">
                        <label>Filters:</label>
                        <a href="{{route('shop')}}" class="">Clear All</a>
                    </div>

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true"
                                aria-controls="widget-1">
                                Category
                            </a>
                        </h3>

                        <div class="collapse show" id="widget-1">
                            <div class="widget-body">
                                <div class="filter-items filter-items-count">

                                    @foreach ($category as $cat)
                                        <div class="filter-item">
                                            <label for="cat-{{ $cat->id }}">
                                                <a href="{{ route('shop', $cat->slug) }}"
                                                    class="text-muted {{ request()->is('shop/' . $cat->slug) ? 'active' : '' }}">
                                                    {{ $cat->name }}
                                                </a>
                                            </label>
                                            <span class="item-count">{{ $cat->products_count }}</span>
                                        </div>
                                    @endforeach




                                    {{-- @foreach ($category as $cat)
                                       <div class="filter-item">
                                           <div class="custom-control custom-checkbox">
                                               <input type="checkbox" class="custom-control-input d-none" id="cat-{{ $cat->id }}" name="category[]" value="{{ $cat->id }}">
                                               <label class="custom-control-label" for="cat-{{ $cat->id }}">{{ $cat->name }}</label>
                                           </div>
                                           <span class="item-count">{{ $cat->products_count }}</span>
                                       </div>
                                        @endforeach --}}
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true"
                                aria-controls="widget-4">
                                Brand
                            </a>
                        </h3>

                        <div class="collapse show" id="widget-4">
                            <div class="widget-body">
                                <div class="filter-items">

                                    {{-- @foreach ($brands as $brand)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="brand-1">
                                                <label class="custom-control-label" for="brand-1">{{ $brand->name }}</label>
                                            </div>
                                        </div>
                                        @endforeach --}}
                                        @foreach ($brands as $brand)
                                        <div class="filter-item">
                                            <label for="brand-{{ $brand->slug }}">
                                                <a href="{{ route('shop', ['brand' => $brand->slug]) }}"
                                                   class="text-muted {{ request()->get('brand') == $brand->slug ? 'active' : '' }}">
                                                    {{ $brand->name }}
                                                </a>
                                            </label>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true"
                                aria-controls="widget-5">
                                Price
                            </a>
                        </h3>

                        <div class="collapse show" id="widget-5">
                            <div class="widget-body">
                                <div class="filter-price">
                                    {{-- <div class="filter-price-text">
                                        Price Range:
                                    </div> --}}
                                    <div class="d-flex">
                                        <input type="number" id="min_price" name="min_price" class="form-control"
                                            placeholder="Min" value="{{ request('min_price') }}">
                                        <span class="mx-2"> - </span>
                                        <input type="number" id="max_price" name="max_price" class="form-control"
                                            placeholder="Max" value="{{ request('max_price') }}">
                                    </div>
                                    <button type="button" class="btn btn-primary mt-2" onclick="filterProducts()">Apply</button>
                                </div>
                                {{-- <div class="filter-price">
                                    <div class="filter-price-text">
                                        Price Range:
                                        <span id="filter-price-range"></span>
                                    </div>

                                    <div id="price-slider"></div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('#sortby').on('change', function () {
                var sortby = $(this).val();
                var url = new URL(window.location.href);
                url.searchParams.set('sortby', sortby);

                window.location.href = url.toString();
            });
        });

        function filterProducts() {
            let min_price = document.getElementById('min_price').value;
            let max_price = document.getElementById('max_price').value;
            let urlParams = new URLSearchParams(window.location.search);

            if (min_price) {
                urlParams.set('min_price', min_price);
            } else {
                urlParams.delete('min_price');
            }

            if (max_price) {
                urlParams.set('max_price', max_price);
            } else {
                urlParams.delete('max_price');
            }

            window.location.search = urlParams.toString();
        }

    </script>
@endpush
