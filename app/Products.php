<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\GeneralProducts;

class Products extends Model
{
    protected $fillable = ['name','price','size','description','general_product_id','quantity'];

    public function general_product()
    {
      return $this->belongsTo(\App\GeneralProducts::class,'general_product_id');
    }

}
