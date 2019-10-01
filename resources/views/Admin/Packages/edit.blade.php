@extends('voyager::master')



@section('page_header')

  @php
    function is_id_exists($array,$p_id)
    {
      foreach($array as $arr)
      {
        if($p_id == $arr)
        {
          return true;
        }
      }
        return false;
    }
  @endphp

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
      <form  action="{{route('package.update',['id' => $package->id])}}" method="post">
          {{csrf_field()}}

          <div class="row">
              <div class="col-sm-2 form-group">
                  <label for="">Package Name</label>
                  <input class="form-control" type="text" name="name" required value="{{$package->name}}" />
              </div>

              <div  class="col-sm-6 form-group">
                <label for="">Select Products For Package</label>

                  <select id="product_selector" required multiple name="product_ids[]">
                    @foreach($gprods as $product)
                          @if(is_id_exists(explode(',',$package->product_ids),$product->id))
                            <option value="{{$product->id}}" selected>{{$product->sku}}</option>
                          @else
                            <option value="{{$product->id}}">{{$product->sku}}</option>
                        @endif
                    @endforeach
                  </select>
              </div>
              <div class="col-sm-4 form-group">
                <label for="">Select Category For Package</label>

                  <select class="form-control" required name="category_id">
                    @foreach($categories as $category)
                        @if($package->category_id == $category->id)
                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                        @else
                          <option value="{{$category->id}}">{{$category->name}}</option>
                      @endif
                    @endforeach
                  </select>

              </div>
              <div class="col-sm-12">
                  <button type="submit" class="btn btn-success pull-right">Update Package</button>
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
