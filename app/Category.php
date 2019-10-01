<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GeneralProducts;

class Category extends Model
{
    protected $fillable = ['name'];

    protected $guard = ['id'];


    public function packages()
    {
      return $this->hasMany(\App\Package::class);
    }
}
