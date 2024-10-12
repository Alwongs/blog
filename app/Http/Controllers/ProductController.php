<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductList;
use App\Models\Product;

class ProductController extends Controller
{
    public function activateProducts($product_list_id)
    {
        $products = Product::where('product_list_id', $product_list_id)->where('status', 'D')->update(['status' => 'A']);

        return redirect()->back()->with('info', 'All products are active!'); 
    }

    public function disableProducts($product_list_id)
    {
        $products = Product::where('product_list_id', $product_list_id)->where('status', 'A')->update(['status' => 'D']);

        return redirect()->back()->with('info', 'All products are disable!'); 
    }
}
