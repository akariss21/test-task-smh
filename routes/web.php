<?php

use Illuminate\Support\Facades\Route;

Route::get('/iphones', function () {
    return Product::where('title', 'like', '%iphone%')->get();
});
