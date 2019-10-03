<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
class CategoryController extends Controller
{

    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at','desc')->paginate(50);
        return view('Admin.Categories.browse')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Categories.create');
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
        $file = $this->uploadOne($image,$folder="category");
        $cat = $request->except('_token');
        $cat['image'] = $file;
        Category::create($cat);
        return redirect()->route('category.browse');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {


      $category = Category::find($request->id);
      return view('Admin.Categories.edit')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $image = $request->file('image');
      $file = $this->uploadOne($image,$folder="category");
      $cat = $request->except('_token');
      $cat['image'] = $file;
      $category = Category::where('id',$request->id)->update($cat);
      return redirect()->route('category.browse');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category = Category::find($request->id);
        $cat = $category->packages;
        if($cat && count($cat) > 0)
        {
          $category->packages()->delete();
        }
        $category->delete();
        return redirect()->route('category.browse');
    }
}
