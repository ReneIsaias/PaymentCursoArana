<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(9);

        return view('welcome', compact('products'));
    }

    public function pay(Product $product)
    {
        return view('products.pay', compact('product'));
    }
}
