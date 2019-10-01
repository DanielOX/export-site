@extends('layouts.app')
@section('content')


  <div class="container">
    <form class="" action="index.html" method="post">
      <div class="row">
        <div class="col-sm-12 form-group">
          <input type="text" class="mx-auto d-block form-control" placeholder="Search Packages or Products" name="search" />
        </div>
      </div>
    </form>

    <div class="row">
      <div class="col-sm-4" >
          <div class="affix" style="width:25%">
            <ul class="list-group">
              <li class="list-group-item" style="background-color:black;color:white"> <b>Categories</b> </li>
            @foreach (App\Category::orderBy('name','asc')->get() as $category)
                  <li class="list-group-item" > <input type="checkbox"  value="{{$category->id}}"> <span>{{$category->name}}</span> </li>
            @endforeach
          </ul>

          <ul class="list-group">
            <li class="list-group-item" style="background-color:black;color:white"> <b>Packages</b> </li>
          @foreach (App\Package::orderBy('name','asc')->get() as $category)
                <li class="list-group-item" > <input type="checkbox"  value="{{$category->id}}"> <span>{{$category->name}}</span> </li>
          @endforeach
        </ul>


          </div>

      </div>
      <div class="col-sm-8">
        @php $i = 0; @endphp
        @foreach ($packages as $package)
          @php $sub_prods = $package->getsubproducts() @endphp
          <div class="card">
            <h4>{{$package->name}}</h4>
            <hr>
            <p>
              <table class="table">
                <thead>
                  <th>Name</th>
                  <th>Package Category</th>
                  <th>Total Products</th>
                </thead>
                <tbody>
                  <tr>
                    <td>{{$package->name}}</td>
                    <td>{{$package->category->name}}</td>
                    <td>{{count($sub_prods)}}</td>
                  </tr>
                </tbody>
              </table>
            </p>
            <h4>Products</h4>
            <hr>
              <div class="ac-container ac-container-{{$i}}">
          @if($package->product_ids && count(explode(',',$package->product_ids)) > 0)
          @foreach ($package->getProducts() as $gproduct)
                  <div class="ac">
                    <a class="ac-q">
                      <table class="table table-bordered black prods_general">
                        <thead>
                          <td>SKU</td>
                          <td>Description</td>
                        </thead>
                        <tbody>
                          <tr >
                            <td>{{$gproduct->sku}}</td>
                            <td>{{$gproduct->description}}</td>
                          </tr>
                        </tbody>
                      </table>
                    </a>
                      <div class="ac-a" style="background-color:#f5f5f5">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <th>SKU-Pack Size</th>
                            <th>Availability</th>
                            <th>Pack Size</th>
                            <th>Price (PKR)</th>
                          </thead>
                          <tbody>
                            @foreach ($gproduct->sub_products as $sproduct)
                              <tr>
                                <td>{{$gproduct->sku}} - {{$sproduct['size']}}</td>
                                <td>
                                  @if($sproduct->quantity > 0)
                                 <i class="voyager-check-circle" style="color:green">  </i> <b>{{$sproduct->quantity}}</b> &nbsp; Avaialble For {{ \Carbon\Carbon::now()->format('d-m-Y') }}
                                @else
                                   <span style="color:red">&#9746	</span> Unavaialble For {{ \Carbon\Carbon::now()->format('d-m-Y') }}
                                @endif

                                </td>
                                <td>{{$sproduct['size']}}</td>
                                <td>{{number_format($sproduct['price'])}}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                </div>


            @endforeach
          @endif
          </div>
          @php  $i++ @endphp

          </div>
          <br><br>
        @endforeach
      </div>
    </div>

  </div>

@endsection

@section('scripts')
  <script type="text/javascript" src="{{URL::to('/js/accordion.js')}}"></script>
  <script type="text/javascript">
  window.onload = function(){
    var container = document.getElementsByClassName('ac-container')
    for (var i = 0; i < container.length; ++i) {
      new Accordion('.ac-container-'+i)
    }

  }
  </script>
  <style media="screen">
    .ac>.ac-q::after{
      content:"\26DB" !important;
    }
    .prods_general > * {
      font-weight: 100;
    }
  </style>

@endsection
