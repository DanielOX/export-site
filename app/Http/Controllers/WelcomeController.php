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
      $packages = Package::distinct()->orderBy('created_at','desc')->paginate(10);
       return view('welcome')->with('packages',$packages);
   }
}
