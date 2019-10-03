@extends('layouts.app')
@section('content')


  <div class="container">
    <form  action="" method="post">
      <div class="row">
        <div class="col-sm-12 form-group">
          {{csrf_field()}}
          <input type="text" class="mx-auto d-block form-control" placeholder="Search Packages" name="search" />

        </div>
      </div>
    </form>

    <div class="row">
      <div class="col-sm-4" >
          <div class="affix" style="width:25%">
            <ul class="list-group shadow">
              <li class="list-group-item" style="background-color:black;color:white"> <b>Categories</b> </li>
            @foreach (App\Category::orderBy('name','asc')->get() as $category)
                  @if($search && $search['id'] && $search['type'] && $search['type'] == 'category')
                    @if($search['id'] == $category->id)
                      <li class="list-group-item" > <input checked type="radio" onchange="search({{$category->id}},'category')"  value="{{$category->id}}"> <span>{{$category->name}}</span> </li>
                    @else
                      <li class="list-group-item" > <input type="radio" onchange="search({{$category->id}},'category')"  value="{{$category->id}}"> <span>{{$category->name}}</span> </li>
                    @endif
                  @else
                    <li class="list-group-item" > <input type="radio" onchange="search({{$category->id}},'category')"  value="{{$category->id}}"> <span>{{$category->name}}</span> </li>
                  @endif
            @endforeach
          </ul>

          <ul class="list-group shadow">
            <li class="list-group-item" style="background-color:black;color:white"> <b>Packages</b> </li>
          @foreach (App\Package::orderBy('name','asc')->get() as $package)

            @if($search && $search['id'] && $search['type'] && $search['type'] == 'package')
              @if($search['id'] == $package->id)
                <li class="list-group-item" > <input checked onchange="search({{$package->id}},'package')" type="radio"  value="{{$package->id}}"> <span>{{$package->name}}</span> </li>
              @else
                <li class="list-group-item" > <input onchange="search({{$package->id}},'package')" type="radio"  value="{{$package->id}}"> <span>{{$package->name}}</span> </li>
              @endif
            @else
              <li class="list-group-item" > <input onchange="search({{$package->id}},'package')" type="radio"  value="{{$package->id}}"> <span>{{$package->name}}</span> </li>
            @endif

          @endforeach
        </ul>


          </div>

      </div>
      <div class="col-sm-8">
        @php $i = 0; @endphp

        @if($search && $search['id'] && $search['type'])
          <div class="card shadow" style="text-align:center">
              <h5>Currently showing results for <b>{{$search['name']}}&nbsp;{{$search['type']}}</b> </h5>
          </div>
          <br>
        @endif

        @if(!$packages || count($packages) <= 0)
          <div class="card shadow" style="text-align:center">
            <h4>Sorry, No packages are available </h4>
            <hr style="width:25%;color:#000" >
          </div>
        @else
          <div class="mx-auto d-block" style="text-align:center">
            {{ $packages->links() }}
          </div>
        @foreach ($packages as $package)
          @php $sub_prods = $package->getsubproducts() @endphp
          <div class="card shadow">
            <h4 class="pull-right"> <span style="font-size:14px">Rs.</span> <b>{{$package->totalprice}}</b>  </h4>
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
                                   <span style="color:red">&#9746	</span> Unavaialble
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
      @endif

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
  <script type="text/javascript">
      function search($id,$type)
      {
        window.location.replace(`{{URL::to('/')}}/search/${$id}/${$type}`)
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
