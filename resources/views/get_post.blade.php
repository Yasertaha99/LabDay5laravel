<?php 
use Carbon\Carbon;
?>


@extends('layouts.app')

@section('content')


<div class='container'>





<div class="card mt-5 p-3"  >
    <!-- <p>{{$post->image}}</p> -->
 

  <img class="mt-3 me-3" src="{{ asset('uploads/' . $post->image) }}" alt="Card image cap" width = '250' height = '250'>
  <div class="card-body">
  <h5 class="card-header"><strong>{{$post['title']}}</strong></h5>
  <div class="card-body">
    <h5 class="card-title">Creator: {{$post['creator_name']}}</h5>
    <p class="card-text">{{$post['content']}}</p>
    <?php

$date = Carbon::parse($post['create_date']);


      ?>
    
    <p class="card-text border shadow p-2 text-center">{{$date->format('l jS \of F Y ')}}</p>

  </div>
</div>
  
  </div>




    </div>

@endsection
