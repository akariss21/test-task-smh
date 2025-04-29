<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'external_id',
        'title',
        'description',
        'price',
        'brand',
        'category',
        'thumbnail',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'float',
    ];
}
