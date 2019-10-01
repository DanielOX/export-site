@extends('voyager::master')

@section('page_header')

  @include('voyager::alerts')
  @include('voyager::dimmers')
  <h1 class="page-title">
      <i class="voyager-bag"></i>
      <p> {{ 'Packages' }}</p>
  </h1>
  <span class="page-description">{{ 'Create Packages' }}</span>
  <a href="{{ route('package.browse') }}" class="btn btn-success btn-lg pull-right"> <i class="voyager-angle-left"></i> Go Back</a>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.min.css">
<style media="screen">
  .optgroup-header{
    font-weight: bold;
  }
</style>
@endsection
@section('content')

  <div class="page-content container">
      <form  action="{{route('package.store')}}" method="post">
          {{csrf_field()}}

          <div class="row">
              <div class="col-sm-2 form-group">
                  <label for="">Package Name</label>
                  <input class="form-control" type="text" name="name" required value="" />
              </div>

              <div  class="col-sm-6 form-group">
                <label for="">Select Products For Package</label>

                  <select id="product_selector" required multiple name="product_ids[]">
                    @foreach($gprods as $product)
                          <option value="{{$product->id}}">{{$product->sku}}</option>                       
                    @endforeach
                  </select>
              </div>
              <div class="col-sm-4 form-group">
                <label for="">Select Category For Package</label>

                  <select class="form-control" required name="category_id">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>

              </div>
              <div class="col-sm-12">
                  <button type="submit" class="btn btn-success pull-right">Add Package</button>
              </div>
          </div>
      </form>

  </div>



@endsection


@section('javascript')
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.js"></script>
  <script type="text/javascript">
      $('#product_selector').selectize({
        maxItems:100
      })
  </script>
@endsection
