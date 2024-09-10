<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sid',
        'sku',
        'title',
        'variant',
        'price',
        'product_id',
        'extrafields',
        'description',
        'status',
        'image_url',
        'barcode'
    ];

}
