@extends('voyager::master')

@section('page_header')
  @include('voyager::alerts')
  @include('voyager::dimmers')
  <h1 class="page-title">
      <i class="voyager-bag"></i>
      <p> {{ 'Products' }}</p>
  </h1>
  <span class="page-description">{{ 'Browse Products' }}</span>
  <a href="{{ route('products.create') }}" class="btn btn-success btn-lg pull-right"> <i class="voyager-plus"></i> Add Product </a>
@endsection

@section('content')
  <div class="page-content">
    <table class="table table-striped table-bordered">
      <thead>
        <th>Name</th>
        <th>Pack Size</th>
        <th>SKU-Pack-Size</th>
        <th>Available Quantity</th>
        <th>Price (PKR)</th>
        <th>Action</th>
      </thead>
      <tbody>
        @foreach($products as $product)
          <tr>
              <td>{{$product->name}}</td>
              <td>{{$product->size}}</td>
              <td>{{$product->general_product->sku}} - {{$product->size}}</td>
              <td>
                @if($product->quantity > 0)
               <i class="voyager-check-circle" style="color:green">  </i> <b>{{$product->quantity}}</b> Avaialble For {{ \Carbon\Carbon::now()->format('d-m-Y') }}
              @else
                 <span style="color:red">&#9746	</span> Unavaialble For {{ \Carbon\Carbon::now()->format('d-m-Y') }}
              @endif
              </td>
              <td>
                @if(is_int((int) $product->price))
                  {{ number_format($product->price) }}
                @endif
              </td>
              <td>
                <a href="{{route('products.edit',['id' => $product->id])}}" class="btn btn-primary">Edit</a>
                <a href="{{route('products.delete',['id' => $product->id])}}" class="btn btn-danger">Delete</a>
              </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
