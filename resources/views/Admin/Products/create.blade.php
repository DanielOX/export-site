@extends('voyager::master')
use App\GeneralProducts;

@section('page_header')
  @include('voyager::alerts')
  @include('voyager::dimmers')
  <h1 class="page-title">
      <i class="voyager-bag"></i>
      <p> {{ 'Products' }}</p>
  </h1>
  <span class="page-description">{{ 'Create Products' }}</span>
  <a href="{{ route('products.browse') }}" class="btn btn-success btn-lg pull-right"> <i class="voyager-angle-left"></i> Go Back </a>
@endsection

@section('content')
  <div class="container">
    <div class="page-content">
      <h4> Add New Product  </h4>
      <hr>

      <form  action="{{route('products.store')}}" method="post">
          {{ csrf_field() }}

          <div class="row">
            <div class="col-sm-3 form-group">
              <label for="">Product Name</label>
              <input type="text" class="form-control" name="name" placeholder="name" required >
            </div>
              <div class="col-sm-2 form-group">
                <label for="">Size</label>
                <input type="text" class="form-control" name="size" placeholder="Size" required >
              </div>
              <div class="col-sm-2 form-group">
                <label for="">Price</label>
                <input type="text" class="form-control" name="price" placeholder="Price (PKR)" required >
              </div>
              <div class="col-sm-4 form-group">
                <label for="">Choose General Products</label>
                <select class="form-control" required name="general_product_id">
                  <option value="" >Category</option>
                    @foreach(App\GeneralProducts::all() as $gprod)
                      <option value="{{$gprod->id}}"> SKU - {{$gprod->sku}}</option>
                    @endforeach
                </select>
              </div>

          </div>


          <div class="row">
            <div class="col-sm-12 form-group">
              <label for="">Description</label>
              <textarea class="form-control" name="description" placeholder="Product Description"  required rows="8"></textarea>
              <button type="submit" class="btn btn-success pull-right">Add Product</button>

            </div>

          </div>
      </form>
















    </div>

  </div>
@endsection
