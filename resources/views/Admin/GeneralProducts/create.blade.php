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
      <h4> Add New Product  </h4>
      <hr>

      <form  action="{{route('generalproducts.store')}}" method="post">
          {{ csrf_field() }}

          <div class="row">
              <div class="col-sm-4 form-group">
                <label for="">SKU</label>
                <input type="text" class="form-control" name="sku" placeholder="SKU" required >
              </div>
              <div class="col-sm-8 form-group">
                <label for="">Description</label>
                <textarea class="form-control" name="description" placeholder="General Product Description"  required rows="4"></textarea>
                <button type="submit" class="btn btn-success pull-right">Add Product</button>

              </div>

          </div>


      </form>
















    </div>

  </div>
@endsection
