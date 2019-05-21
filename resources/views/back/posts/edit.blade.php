@extends('layouts.admin')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Share
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
        
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('posts.update', $posts->id) }}">
        @method('PATCH')
        @csrf
        <label for="title">Title:</label>
              <input type="text" class="form-control" name="title" value={{ $posts->title }}/>
          </div>
          <div class="form-group">
              <label for="description">Description:</label>
              <input type="text" class="form-control" name="description" value={{ $posts->description }}/>
          </div>
          <div class="form-group">
              <label for="heading">Heading:</label>
              <input type="text" class="form-control" name="heading" value={{ $posts->heading }}/>
          </div>
          <div class="form-group">
              <label for="shortstory">Short Story:</label>
              <input type="text" class="form-control" name="shortstory" value={{ $posts->shortstory }}/>
          </div>
          <div class="form-group">
              <label for="fullstory">Full Story:</label>
              <input type="text" class="form-control" name="fullstory" value={{ $posts->fullstory }}/>
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
              <label for="fimage"> Image :</label>
              <input type="file" class="form-control" name="files" value={{ $posts->fimage }}/>
          </div>
          <div class="form-group">
              <label for="status">Post Status:</label>
              <input type="text" class="form-control" name="status" value={{ $posts->status }}/>
          </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection