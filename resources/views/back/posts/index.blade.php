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
    <a href="{{ route('posts.create')}}" class="btn btn-danger">
    Add Post
    </td>
    </tr>
        <tr>
          <td>ID</td>
          <td>Post Name</td>
          <td>Post Description</td>
          <td>Post Heading</td>
          <td>Post ShortStory</td>
          <td>Post FullStory</td>
          <td>Category Name</td>
          <td>User Id</td>
          <td>Status</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->title}}</td>
            <td>{{$item->description}}</td>
            <td>{{$item->heading}}</td>
            <td>{{$item->shortstory}}</td>
            <td>{{$item->fullstory}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->user_id}}</td>
            <td>{{$item->status}}</td>
            <td><a href="{{ route('posts.edit',$item->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('posts.destroy', $item->id)}}" method="post">
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