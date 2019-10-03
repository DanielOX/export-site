@extends('layouts.app')

@section('libs')
  <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>

  <script type="text/javascript"  defer src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

@endsection
@section('content')



  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<div class="container">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="https://cdn.pixabay.com/photo/2018/01/14/23/12/nature-3082832__340.jpg" style="object-fit:cover" class="container-fluid" alt="Los Angeles">
      </div>

      <div class="item">
        <img src="https://cdn.pixabay.com/photo/2018/02/08/22/27/flower-3140492__340.jpg" alt="Chicago">
      </div>

      <div class="item">
        <img src="https://cdn.pixabay.com/photo/2018/01/14/23/12/nature-3082832__340.jpg" alt="New York">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  {{-- End Carousel --}}
  <br>
  <div class="">
      <h4>Latest Packages</h4>
      <div id="owl-demo">
        @foreach (\App\Package::orderBy('created_at','desc')->take(10)->get() as $packages)
          <div class="item">
            {{$packages->name}}
          </div>
        @endforeach
      </div>

  </div>








</div>



<script type="text/javascript">
  $(window).load(function(){
    jQuery(function($){
      $("#owl-demo").owlCarousel({
        loop : true
      });
    })

  })
</script>
@endsection
