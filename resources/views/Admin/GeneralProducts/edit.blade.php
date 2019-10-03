@extends('voyager::master')

@section('page_header')
  @include('voyager::alerts')
  @include('voyager::dimmers')
  <h1 class="page-title">
      <i class="voyager-bag"></i>
      <p> {{ 'General Products' }}</p>
  </h1>
  <span class="page-description">{{ 'General Products' }}</span>
  <a href="{{ route('generalproducts.browse') }}" class="btn btn-success btn-lg pull-right"> <i class="voyager-angle-left"></i> Go Back </a>
@endsection

@section('content')
  <div class="container">
    <div class="page-content">
      <h4> Edit Product  </h4>
      <hr>

      <form  action="{{route('generalproducts.update',['id' => $gproducts->id])}}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}

          <div class="row">
              <div class="col-sm-4 form-group">
                <label for="">SKU</label>
                <input type="text" class="form-control" value="{{$gproducts->sku}}" name="sku" placeholder="SKU" required >
              </div>
              <div class="col-sm-4 form-group">
                <label for="">General Product Image</label>
                <input type="file" class="form-control" name="image" required />
                <img src="{{Voyager::image($gproducts->image)}}" style="width:150px;height:150px;object-fit:contain" alt="">
              </div>

              <div class="col-sm-4 form-group">
                <label for="">Description</label>
                <textarea class="form-control" name="description" placeholder="General Product Description"  required rows="4">{{$gproducts->description}}</textarea>
                <button type="submit" class="btn btn-success pull-right">Update Product</button>

              </div>

          </div>


      </form>
















    </div>

  </div>
@endsection
