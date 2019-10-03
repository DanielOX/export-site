<?php

namespace App\Http\Controllers;

use App\GeneralProducts;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;

class GeneralProductsController extends Controller
{

    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gprod = GeneralProducts::orderBy('created_at','desc')->paginate(25);
        return view('Admin.GeneralProducts.browse')->with('gproducts',$gprod);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.GeneralProducts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('image');
        $folder = "general_products";
        $file = $this->uploadOne($image,$folder=$folder);
        $prod = $request->except('_token');
        $prod['image'] = $file;

        $gprod = GeneralProducts::create($prod);
        return redirect()->route('generalproducts.browse');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GeneralProducts  $generalProducts
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $general_products =  GeneralProducts::find($request->id);
        return view('Admin.GeneralProducts.show')->with('gprod',$general_products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GeneralProducts  $generalProducts
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

      $gprod = GeneralProducts::find($request->id);
      return view('Admin.GeneralProducts.edit')->with('gproducts',$gprod);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GeneralProducts  $generalProducts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

       $image = $request->file('image');
       $folder = "general_products";
       $file = $this->uploadOne($image,$folder=$folder);
       $prod = $request->except('_token');
       $prod['image'] = $file;


       GeneralProducts::find($request->id)->update($prod);
       $gprod = GeneralProducts::find($request->id);
       return redirect()->route('generalproducts.browse');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GeneralProducts  $generalProducts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $gprod =  GeneralProducts::find($request->id);
      $gprod->delete();
      return redirect()->route('generalproducts.browse');
    }
}
