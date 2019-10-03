<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class GeneralProducts extends Model
{
    protected $fillable = ['sku','description','image'];

    public function sub_products()
    {
       return $this->hasMany(\App\Products::class,'general_product_id');
    }

}
