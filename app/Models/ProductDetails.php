<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'catalogue_price',
        'average_price',
        'wholesale_discount',
        'wholesale_brokerage',
        'total_wholesale_discount',
        'retail_discount',
        'retail_brokerage',
        'totl_retail_discount',
    ];
}
