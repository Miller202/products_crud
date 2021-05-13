<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function save_product(){
        $product = new Product;
        $product->name = request()->name;
        $product->desc = request()->desc;
        $product->type = request()->type;
        $product->save();
    }

    public function list_products(){
        $products = Product::paginate(3);
        return response()->json($products);
    }
}
