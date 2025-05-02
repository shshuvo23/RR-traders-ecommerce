<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Order;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\ProductGallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ProductGallery::class, 'product_id', 'id');
    }
    public function feature()
    {
        return $this->hasMany(ProductFeature::class, 'product_id', 'id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }
}
