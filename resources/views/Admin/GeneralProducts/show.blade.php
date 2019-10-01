@extends('voyager::master')
use App\GeneralProducts;

@section('page_header')
  @include('voyager::alerts')
  @include('voyager::dimmers')
  <h1 class="page-title">
      <i class="voyager-bag"></i>
      <p> {{ 'Products' }}</p>
  </h1>
  <span class="page-description">{{ 'Browse Products' }}</span>
  <a href="{{ route('generalproducts.browse') }}" class="btn btn-success btn-lg pull-right"> <i class="voyager-angle-left"></i> Go Back </a>
@endsection

@section('content')
  <div class="page-content">
    <table class="table table-striped table-bordered">
      <thead>
        <th>Name</th>
        <th>Pack Size</th>
        <th>SKU-Pack-Size</th>
        <th>Price (PKR)</th>
      </thead>
      <tbody>
        @foreach($gprod->sub_products as $product)
          <tr>
              <td>{{$product->name}}</td>
              <td>{{$product->size}}</td>
              <td>{{$product->general_product->sku}} - {{$product->size}}</td>
              <td>{{ number_format($product->price) }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
