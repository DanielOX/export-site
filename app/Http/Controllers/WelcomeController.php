<?php

namespace App\Http\Controllers;

use App\Package;
use App\Products;
use App\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
   public function index(Request $request)
   {
       $packages = Package::distinct()->orderBy('created_at','desc')->paginate(25);
       return view('welcome')->with('packages',$packages)->with('search',null);
   }

   public function search(Request $request)
   {
      if($request->search)
      {
        $search = $request->search;
        $packages = Package::query()->where('name','LIKE',"%{$search}%")->paginate(25);
        return view('welcome')->with('packages',$packages)->with('type','search');

      }
   }

   public function search_query($id,$type)
   {
     if(isset($id) && isset($type))
     {
       $packages = "";
       $name = "";
       switch ($type) {
         case 'package':
          $packages = Package::where('id',$id)->paginate(25);
          $name = $packages->first()->name;
           break;
         case "category":
          $packages = Package::where('category_id',$id)->paginate(25);
          $name = Category::where('id',$id)->first()->name;
          break;
         default:
          return redirect()->route('welcome.home');
         break;
       }
       return view('welcome')->with('packages',$packages)->with('search',['id' => $id,'type' => $type,'name' => $name]);
     }
   }

}
