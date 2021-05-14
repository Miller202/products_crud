<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(3);
        return response()->json($products);
    }

    public function store(){
        $product = new Product;
        $product->name = request()->name;
        $product->desc = request()->desc;
        $product->type = request()->type;
        $product->quantity = request()->quantity;
        $product->save();

        return response()->json('Produto cadastrado!');
    }

    public function edit($id){
        $product = Product::find($id);
        return response()->json($product);
    }

    public function update(){
        $product = Product::find(request()->id);
        $product->name = request()->name;
        $product->desc = request()->desc;
        $product->type = request()->type;
        $product->quantity = request()->quantity;
        $product->update();

        return response()->json('Produto atualizado!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json('Produto removido!');
    }
}
