@extends('voyager::master')

@section('page_header')
  @include('voyager::alerts')
  @include('voyager::dimmers')
  <h1 class="page-title">
      <i class="voyager-list"></i>
      <p> {{ 'Cateogry' }}</p>
  </h1>
  <span class="page-description">{{ 'Browse Category' }}</span>
  <a href="{{ route('category.browse') }}" class="btn btn-success btn-lg pull-right"> <i class="voyager-plus"></i> Go Back </a>
@endsection

@section('content')
  <div class="page-content container">
      <form  action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
          <div class="row">
            <div class="col-sm-4">
              <label for="">Category Name</label>
              <input class="form-control" placeholder="Category Name" type="text" name="name" value="">
            </div>

            <div class="col-sm-4">
              <label for="">Category Image</label>
              <input class="form-control" type="file" name="image" />
            </div>


            <div class="col-sm-4">
              <br>
                <button type="submit" class="btn btn-success">Add Category</button>
            </div>
          </div>
      </form>
  </div>
@endsection
