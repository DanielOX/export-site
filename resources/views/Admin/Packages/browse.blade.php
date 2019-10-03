@extends('voyager::master')

@section('page_header')
  @include('voyager::alerts')
  @include('voyager::dimmers')
  <h1 class="page-title">
      <i class="voyager-bag"></i>
      <p> {{ 'Packages' }}</p>
  </h1>
  <span class="page-description">{{ 'Browse Packages' }}</span>
  <a href="{{ route('package.create') }}" class="btn btn-success btn-lg pull-right"> <i class="voyager-plus"></i> Add Package </a>
@endsection

@section('content')
  <div class="container">
    <div class="page-content">
      <table class="table table-striped table-bordered">
        <thead>
          <th>Name</th>
          <th>Package Category</th>
          <th>Action</th>
          <th>Creation Date</th>
          <th>Updation Date</th>

        </thead>
        <tbody>
          @foreach($packages as $package)
            <tr>
                <td>{{$package->name}}</td>
                <td>{{$package->category->name}}</td>
                <td>
                  <a href="{{route('package.show',['id' => $package->id])}}" class="btn btn-success"> View Details</a>
                  <a href="{{route('package.edit',['id' => $package->id])}}" class="btn btn-primary">Edit</a>
                  <a href="{{route('package.delete',['id' => $package->id])}}" class="btn btn-danger">Delete</a>
                </td>
                <td>
                  {{\Carbon\Carbon::parse($package->created_at)->format('d/m/Y')}}
                </td>
                <td>
                  {{\Carbon\Carbon::parse($package->updated_at)->format('d/m/Y')}}
                </td>

            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
