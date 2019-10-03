@extends('voyager::master')

@section('page_header')
  @include('voyager::alerts')
  @include('voyager::dimmers')
  <h1 class="page-title">
      <i class="voyager-list"></i>
      <p> {{ 'Category' }}</p>
  </h1>
  <span class="page-description">{{ 'Edit Category' }}</span>
  <a href="{{ route('category.browse') }}" class="btn btn-success btn-lg pull-right"> <i class="voyager-plus"></i> Go Back </a>
@endsection

@section('content')
  <div class="page-content container">

      <form  action="{{route('category.update',['id' => $category->id])}}" enctype="multipart/form-data" method="post">
          <div class="row">
            {{csrf_field()}}
            <div class="col-sm-4">
              <label for="">Name</label>
              <input type="text" class="form-control" name="name" value="{{$category->name}}">
            </div>
            <div class="col-sm-4">
              <label for="">Category Image</label>
              <input class="form-control" type="file" name="image" />
              <img src="{{Voyager::image($category->image)}}" style="width:150px;height:150px;object-fit:contain" alt="">
            </div>

            <div class="col-sm-4">
              <br>
              <button type="submit" class="btn btn-success ">Edit Category</button>
            </div>
          </div>
      </form>
  </div>
@endsection
