@extends('layouts.admin')
@section('title')
  Add Post
@endsection
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
  <a href="{{ route('posts.index')}}"> All Posts</a>
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br/>
    @endif
      <form method="post" action="{{ route('posts.store') }}" >
          <div class="form-group">
              @csrf
              <label for="title">Title:</label>
              <input type="text" class="form-control" name="title"/>
          </div>
          <div class="form-group">
              <label for="keyword">Keyword</label>
              <input type="text" class="form-control" name="keyword"/>
          </div>
          <div class="form-group">
              <label for="description">Description</label>
              <input type="text" class="form-control" name="description"/>
          </div>
          <div class="form-group">
              <label for="heading">Heading</label>
              <input type="text" class="form-control" name="heading"/>
          </div>
          <div class="form-group">
              <label for="shortstory">Short Story</label>
              <input type="text" class="form-control" name="shortstory"/>
          </div>
          <div class="form-group">
              <label for="fullstory">Full Story</label>
              <input type="text" class="form-control" name="fullstory"/>
          </div>
          <div class="form-group">
              <label for="image">Feature Image :</label>
              <input type="file" class="form-control" name="files"/>
          </div>
          <div class="form-group">
              <label for="Category"> Category :</label>
              <select name="category_id">
              @foreach($cats as $item)
              <option value= " {{ $item->id }} ">{{ $item->name }}  </option> 
              @endforeach
              </select>
          </div>
          <div class="form-group">
              <label for="status">Status</label>
              <input type="text" class="form-control" name="status"/>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>
@endsection