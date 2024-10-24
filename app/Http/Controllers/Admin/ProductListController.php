<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductList\StoreRequest;

class ProductListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_lists = ProductList::orderBy('created_at', 'DESC')->get();

        return view('pages/site/product_lists/manage', compact('product_lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        return view('pages/site/product_lists/update', compact('user_id'));
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

            $product_list = $request->all();

            if ($product_list['user_id'] != Auth::user()->id) {
                return redirect()->back()->with('status', 'not validated!'); 
            }

            ProductList::create($product_list);
            
            return redirect()->route('product-lists.index')->with('info', 'Task has been added!'); 
        } else {
            return redirect()->back()->with('status', 'not validated!'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductList  $productList
     * @return \Illuminate\Http\Response
     */
    public function show(ProductList $product_list)
    {
        $sum = $product_list->products->where('status', 'A')->sum('price');

        return view('pages/site/products/manage', compact('product_list', 'sum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductList  $productList
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductList $product_list)
    {
        return view('pages/site/product_lists/update', compact('product_list')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductList  $productList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductList $product_list)
    {
        $product_list->title = $request->title;
        $product_list->user_id = $request->user_id;
        $product_list->update();

        return redirect()->route('product-lists.index')->with('info', 'Product list has been updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductList  $productList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductList $product_list)
    {
        $product_list->delete();

        return redirect()->back()->with('info', 'Запись успешно удалена'); 
    }
}
