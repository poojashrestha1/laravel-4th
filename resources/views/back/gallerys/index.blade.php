@extends('layouts.admin')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
    <tr>
    <td colspan=8>
    <a href="{{ route('gallerys.create')}}" class="btn btn-danger">
    Add Gallery
    </td>
    </tr>
        <tr>
        <td>ID</td>
          <td>Gallery Name</td>
          <td>Titile</td>
          <td>Description</td>
          <td>Image</td>
          <td>Status</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($gallerys as $item)
        <tr>
            <td>{{$item->gtype}}</td>
            <td>{{$item->title}}</td>
            <td>{{$item->description}}</td>
            <td>{{$item->files}}</td>
            <td>{{$item->status}}</td>
            <td><a href="{{ route('gallerys.edit',$gallerys->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('gallerys.destroy', $gallerys->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection