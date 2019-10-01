@extends('voyager::master')
use App\GeneralProducts;

@section('page_header')
  @include('voyager::alerts')
  @include('voyager::dimmers')
  <h1 class="page-title">
      <i class="voyager-bag"></i>
      <p> {{ 'Products' }}</p>
  </h1>
  <span class="page-description">{{ 'Edit Products' }}</span>
  <a href="{{ route('products.browse') }}" class="btn btn-success btn-lg pull-right"> <i class="voyager-angle-left"></i> Go Back </a>
@endsection

@section('content')
  <div class="container">
    <div class="page-content">
      <h4> Edit Product  </h4>
      <hr>

      <form  action="{{route('products.update',['id' => $product->id])}}" method="post">
          {{ csrf_field() }}

          <div class="row">
            <div class="col-sm-2 form-group">
              <label for="">Product Name</label>
              <input type="text" class="form-control" name="name" placeholder="name" required value="{{$product->name}}">
            </div>
              <div class="col-sm-2 form-group">
                <label for="">Size</label>
                <input type="text" class="form-control" name="size" placeholder="Size" required value="{{$product->size}}">
              </div>
              <div class="col-sm-2 form-group">
                <label for="">Price</label>
                <input type="text" class="form-control" name="price" placeholder="Price (PKR)" required value="{{$product->price}}">
              </div>
              <div class="col-sm-3 form-group">
                <label for="">Quantity</label>
                <input type="number" class="form-control" name="quantity" placeholder="Quantity" required >
              </div>
              <div class="col-sm-4 form-group">
                <label for="">Choose Product Category</label>
                <select class="form-control" required name="general_product_id">
                  <option value="" >Category</option>
                    @foreach(App\GeneralProducts::all() as $category)
                        @if($category->id == $product->general_product_id)
                          <option value="{{$category->id}}" selected>SKU - {{$category->sku}}</option>
                        @else
                          <option value="{{$category->id}}">SKU - {{$category->sku}}</option>
                        @endif
                    @endforeach
                </select>
              </div>
          </div>


          <div class="row">

            <div class="col-sm-12 form-group">
              <label for="">Description</label>

              <textarea class="form-control" name="description" placeholder="Product Description"  required rows="8">{{$product->description}}</textarea>
              <button type="submit" class="btn btn-success pull-right">Update Product</button>

            </div>

          </div>
      </form>
















    </div>

  </div>
@endsection
