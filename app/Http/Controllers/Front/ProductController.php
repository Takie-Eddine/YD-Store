<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){


    }



    public function show(Product $product){

        if($product->status != 'active'){
            return redirect()->route('products.index')->with(['toast_error' => 'Not found']);
            abort(404);
        }

        return view('front.products.show',compact('product'));

    }
}
