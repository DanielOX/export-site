@extends('voyager::master')

@section('page_header')
  @include('voyager::alerts')
  @include('voyager::dimmers')
  <h1 class="page-title">
      <i class="voyager-list"></i>
      <p> {{ 'category' }}</p>
  </h1>
  <span class="page-description">{{ 'Browse Category' }}</span>
  <a href="{{ route('category.create') }}" class="btn btn-success btn-lg pull-right"> <i class="voyager-plus"></i> Add category </a>
@endsection

@section('content')
  <div class="page-content">
    <div class="alert alert-warning" role="alert">
  <b>Caution!</b> Deleting A Category Will Delete The Related Products!
</div>
    <table class="table table-striped table-bordered">
      <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Image</th>
        <th>Action</th>
        <th>Creation Date</th>
        <th>Updation Date</th>

      </thead>
      <tbody>
        @foreach($categories as $category)
          <tr>
              <td>{{'Cat #'.$category->id}}</td>
              <td>{{$category->name}}</td>
              <td> <img src="{{Voyager::image($category->image)}}" width="100" height="100" style="object-fit:contain" /> </td>

              <td>
                <a href="{{route('category.edit',['id' => $category->id])}}" class="btn btn-primary">Edit</a>
                <a href="{{route('category.delete',['id' => $category->id])}}" class="btn btn-danger">Delete</a>

              </td>
              <td>
                {{\Carbon\Carbon::parse($category->created_at)->format('d/m/Y')}}
              </td>
              <td>
                {{\Carbon\Carbon::parse($category->updated_at)->format('d/m/Y')}}
              </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
