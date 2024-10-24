<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Enum\Status;

class ProductController extends Controller
{
    public function activateProducts($product_list_id)
    {
        Product::where('product_list_id', $product_list_id)
            ->where('status', Status::DISABLE)
            ->update(['status' => Status::ACTIVE]);

        return redirect()->back()->with('info', 'All products are active!'); 
    }

    public function disableProducts($product_list_id)
    {
        Product::where('product_list_id', $product_list_id)
            ->where('status', Status::ACTIVE)
            ->update(['status' => Status::DISABLE]);

        return redirect()->back()->with('info', 'All products are disable!'); 
    }
}
