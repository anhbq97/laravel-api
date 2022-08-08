<?php

namespace App\Models;

use App\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = ['id', 'name', 'status', 'price', 'brand_id', 'product_category_id'];

    public static function products()
    {
        $products = Product::select('product.id', 'product.name', 'product.status as product_status', 'product.price', 'brand.name as brand_name', 'product_category.name as product_category_name')
        ->leftJoin('product_category', 'product_category.id', '=', 'product.product_category_id')
        ->leftJoin('brand', 'brand.id', '=', 'product.brand_id')
        ->where('product.status', Constants::PRODUCT_STATUS_ACTIVE)
        ->orderBy('product.created_at', 'desc')
        ->paginate(3);

        return $products;
    }


}

