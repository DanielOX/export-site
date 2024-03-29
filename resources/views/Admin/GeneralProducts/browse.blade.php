@extends('voyager::master')

@section('page_header')
  @include('voyager::alerts')
  @include('voyager::dimmers')
  <h1 class="page-title">
      <i class="voyager-bag"></i>
      <p> {{ 'General Products' }}</p>
  </h1>
  <span class="page-description">{{ 'Browse General Products' }}</span>
  <a href="{{ route('generalproducts.create') }}" class="btn btn-success btn-lg pull-right"> <i class="voyager-plus"></i> Add Product </a>
@endsection

@section('content')
  <div class="page-content">
    <table class="table table-striped table-bordered">
      <thead>
        <th>SKU</th>
        <th>Image</th>
        <th>Description</th>
        <th>Action</th>
        <th>Creation Date</th>
        <th>Updation Date</th>
      </thead>
      <tbody>
        @foreach($gproducts as $product)
          <tr>
              <td>{{$product->sku}}</td>
              <td> <img src="{{Voyager::image($product->image)}}" width="100" height="100" style="object-fit:contain" /> </td>
              <td>{{$product->description}}</td>
              <td>
                <a href="{{route('generalproducts.edit',['id' => $product->id])}}" class="btn btn-primary">Edit</a>
                <a href="{{route('generalproducts.delete',['id' => $product->id])}}" class="btn btn-danger">Delete</a>
                <a href="{{route('generalproducts.show',['id' => $product->id])}}" class="btn btn-warning">View Sub Products</a>
              </td>
              <td>
                {{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y')}}
              </td>
              <td>
                {{\Carbon\Carbon::parse($product->updated_at)->format('d/m/Y')}}
              </td>

          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
