<?php 
use Carbon\Carbon;
?>


@extends('layouts.app')

@section('content')


<div class='container text-center '>


@if (session('error'))
        <div class="alert alert-danger shadow" role="alert">
            {{ session('error') }}
        </div>
    @endif

    </div>

<div class='container'>






<table class="table mt-5">
  <thead>
    <tr>
      <th scope="col">id </th>
      <th scope="col">Tilte</th>
      <th scope="col">Slug</th>

      <th scope="col">Posted By</th>
      <th scope="col">Created At</th>
      <th scope="col">image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($posts as $post)

    <div class='container'>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Deleting Post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this post 
          <p>{{$post->id}}</p>
          <p>{{$post->slug}}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <form action="{{route('posts.destroy',$post)}}" method = 'post'>
          @csrf  
          @method('DELETE')
          <input type='submit'  value ='Confirm Deleting' class="btn btn-danger">
          </form>
        </div>
      </div>
  </div>
</div>
</div>



    <tr>
      
      <td>{{$post['id']}}</td>
      <td>{{$post['title']}}</td>
      <td>{{$post->slug}}</td>
      <?php

$date = Carbon::parse($post['create_date']);

//  $date->format('l jS \of F Y h:i:s A');

      ?>
      
      <td>{{$post['creator_name']}}</td>
      
      <td>{{$date->format('l jS \of F Y ')}}</td>
      <td><img src="{{ asset('uploads/' . $post->image) }}" alt="post image" width = '75' ></td>


      <td>
        @if($post['deleted_at'] == NULL)
        
      <a href="{{route('posts.show',$post)}}" class="btn btn-primary m-3">
            <i class="bi bi-eye"></i> View
        </a>
        <a href="{{route('posts.edit',$post)}}" class="btn btn-warning m-3">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
  Delete 
</button>
@else
<a href="{{route('posts.restore',$post)}}" class="btn btn-warning m-3">
            <i class="bi bi-pencil"></i> Restore
        </a>
@endif
</td>
    </tr>





    @endforeach  
 
    <tr>
      
      <div class="pagination justify-content-center mt-4">
    {{ $posts->links('pagination::bootstrap-4') }}
</div>
      
    </tr>
  </tbody>
</table>



  


    </div>

</div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>