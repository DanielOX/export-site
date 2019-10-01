<?php

namespace App\Http\Controllers;

use App\Package;
use App\Category;
use App\Products;
use App\GeneralProducts;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::paginate(25);
        return view('Admin.Packages.browse')->with('packages',$packages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $gprod = GeneralProducts::all();
        return view('Admin.Packages.create')
               ->with('categories',$categories)
               ->with('gprods',$gprod);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


      $p_ids = [
        'name' => $request->name,
        'product_ids' => implode(',',$request->product_ids),
        'category_id' => $request->category_id,
    ];


        $package = Package::create($p_ids);
        return redirect()->route('package.show',['id' => $package->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $package = Package::find($request->id);
        return view('Admin.Packages.show')->with('package',$package);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $package = Package::find($request->id);
        $gprods = GeneralProducts::all();
        $categories = Category::all();
        return view('Admin.Packages.edit')
               ->with('package',$package)
               ->with('categories',$categories)
               ->with('gprods',$gprods);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

      $p_ids = [
            'name' => $request->name,
            'product_ids' => (string)implode(',',$request->product_ids),
            'category_id' => $request->category_id,
        ];

        Package::find($request->id)->update($p_ids);
        return redirect()->route('package.show',['id' => $request->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Package::find($request->id)->delete();
        return redirect()->route('package.browse');

    }

}
