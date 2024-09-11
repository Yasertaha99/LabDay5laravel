@extends('layouts.app')

@section('content')


<div class='container mt-5 shadow'>

<form class="p-5" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf  
    @error('title')
    <div class="alert alert-warning" role="alert">
    {{ $message }}
</div>
            @enderror



            <div class="form-group">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" >
        </div>



        @error('content')
    <div class="alert alert-warning" role="alert">
    {{ $message }}
</div>
            @enderror
        
            <div class="input-group-append mt-3 mb-3">
            <label for="content" class="form-label">Description</label>
            <textarea class="form-control" id="content" name="content" rows="3" placeholder="Enter description" ></textarea>
        </div>
        
   

@error('image')
    <div class="alert alert-warning" role="alert">
    {{ $message }}
</div>
            @enderror


        <div class="form-group mt-3 " >
    <label for="formControlFile1">Add post image</label><br>
    <input type="file" class="form-control-file" name='image' id="formControlFile1">
  </div>

        <input type="submit" value='create' class="btn btn-primary mt-5">
    </form>
    </div>
    @endsection