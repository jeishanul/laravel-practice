<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('product.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('orderDetails')->firstOrFail();
        return view('product.show', compact('product'));
    }
}
