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
                    <a href="#" class="ac-q">{{$gproduct->sku}}</a>
                      <div class="ac-a">
                        <table class="table table-striped">
                          <thead>
                            <th>SKU-Pack Size</th>
                            <th>Pack Size</th>
                            <th>Price (PKR)</th>
                          </thead>
                          <tbody>
                            @foreach ($gproduct->sub_products as $sproduct)
                              <tr>
                                <td>{{$gproduct->sku}} - {{$sproduct['size']}}</td>
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
@endsection
