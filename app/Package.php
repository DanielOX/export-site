<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\GeneralProducts;

class Package extends Model
{
    protected $fillable = ['name','product_ids','total_price','total_products','category_id'];

    public function category()
    {
      return $this->belongsTo(\App\Category::class,'category_id');
    }

    public function getProducts()
    {
        return \App\GeneralProducts::find(explode(',',$this->product_ids));
    }

    public function getsubproducts()
    {
      $ids =  [];
      foreach ($this->getProducts() as $general_products) {
          $ids[] = $general_products->id;
      }
      return \App\Products::whereIn('general_product_id',$ids)->get();
    }

}
