<?php

namespace App\Http\Controllers;

use App\Models\Admin\Category;
use App\Models\Product;

class WelcomeController extends Controller
{
    public function index() {
        $categories = Category::with(['subCategories'])->whereNull('parent_id')->get();
        $products = Product::get();
        return view('product.welcome',compact('products','categories'));
    }

}
