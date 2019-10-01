@extends('voyager::master')
use App\GeneralProducts;

@section('page_header')
  @include('voyager::alerts')
  @include('voyager::dimmers')
  <h1 class="page-title">
      <i class="voyager-bag"></i>
      <p> {{ $package->name }}</p>
  </h1>
  <span class="page-description">{{ 'Package Information' }}</span>
  <a href="{{ route('package.browse') }}" class="btn btn-success btn-lg pull-right"> <i class="voyager-angle-left"></i> Go Back </a>
@endsection

@section('content')
  <div class="page-content">
    <table class="table table-striped table-bordered">
      <thead>
        <th>SKU</th>
        <th>Name</th>
        <th>Sub Products</th>
      </thead>
      <tbody>
        @foreach(explode(',',$package->product_ids) as $pids)
          @php $product = \App\GeneralProducts::where('id',$pids)->get()->first(); @endphp
          <tr>
              <td>{{$product->sku}}</td>
              <td>{{$product->description}}</td>
              <td>
                  @php $sub_prods = $product->sub_products; @endphp
                  @if($sub_prods && count($sub_prods) > 0)
                <table class="table table-striped table-bordered">
                  <thead>
                    <th>Name</th>
                    <th>Pack Size</th>
                    <th>SKU-Pack-Size</th>
                    <th>Price (PKR)</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    @foreach($sub_prods as $sbp)
                      <tr>
                          <td>{{$sbp->name}}</td>
                          <td>{{$sbp->size}}</td>
                          <td>{{$sbp->general_product->sku}} - {{$sbp->size}}</td>
                          <td>
                            @if(is_int((int) $sbp->price))
                              {{ number_format($sbp->price) }}
                            @endif
                          </td>
                          <td>
                            <a href="{{route('products.edit',['id' => $sbp->id])}}" class="btn btn-primary">Edit</a>
                            <a href="{{route('products.delete',['id' => $sbp->id])}}" class="btn btn-danger">Delete</a>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @else
                <i>No Subproducts</i>
              @endif
              </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
