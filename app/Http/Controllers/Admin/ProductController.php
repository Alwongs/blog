<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductList;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Product\StoreRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_list_id = $_REQUEST['product_list_id'];

        return view('pages/site/products/update', compact('product_list_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        if ($request->validated()) {

            $product = $request->all();

            Product::create($product);
            
            return redirect()->route('product-lists.show', $product['product_list_id'])->with('info', 'Post has been added!'); 
        } else {
            return redirect()->back()->with('status', 'not validated!'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product_list_id = $product->product_list_id;

        return view('pages/site/products/update', compact('product', 'product_list_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->product_list_id = $request->product_list_id;
        $product->title = $request->title;
        $product->rate = $request->rate;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->update();

        return redirect()->route('product-lists.show', $product->product_list_id)->with('info', 'Post has been updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back()->with('info', 'Запись успешно удалена'); 
    }
}
