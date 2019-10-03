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
  <style media="screen">
  .thead-dark th {
          color: #fff !important;
          background-color: #373a3c !important;
          border-color:grey !important;

      }
    .tbody-dark tr {
              color: #fff !important;
              background-color: #373a3c !important;

          }
    .tbody-dark tr td {
        border-color:grey !important;
    }

  </style>

  <div class="page-content">
    <table class="table table-striped table-bordered">
      <thead>
        <th>SKU</th>
        <th>Name</th>
        <th>Sub Products</th>
        <th>Creation Date</th>
        <th>Updation Date</th>
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
                <div class="container-fluid">
                  <table class="table table-striped ">
                    <thead class="thead-dark">
                      <th>Name</th>
                      <th>Pack Size</th>
                      <th>SKU-Pack-Size</th>
                      <th>Price (PKR)</th>
                      <th>Action</th>
                    </thead>
                    <tbody class="tbody-dark">
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

                </div>
              @else
                <i>No Subproducts</i>
              @endif
              </td>
              <td>
                {{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y')}}
              </td>
              <td>
                {{\Carbon\Carbon::parse($product->updated_at)->format('d/m/Y')}}
              </td>
              <td></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
