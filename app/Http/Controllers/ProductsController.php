<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products = Products::paginate(25);
      return view('Admin.Products.browse')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Products::create($request->except('_token'));
      return redirect()->route('products.browse')->with(['message' => 'Product Created','alert-type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $product = Products::find($request->id);
        return view('Admin.Products.edit')->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
          Products::where('id',$request->id)->update($request->except('_token'));

          return redirect()->route('products.browse')->with(['message' => 'Product Updated','alert-type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Products::find($request->id);
        $product->delete();
        return redirect()->back()->with(['message' => 'Product Deleted','alert-type' => 'success']);
    }
}
