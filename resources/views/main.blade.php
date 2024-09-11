


@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <a class="btn btn-success" href="{{ route('posts.create') }}">Create</a>
</div>

<div class="container mt-5">
    @foreach($posts as $post)
        <div class="card mt-5 p-3">
            @if($post->image)
                <img class="mt-3 me-3" src="{{ asset('uploads/' . $post->image) }}" alt="Card image cap" width="250" height="250">
            @endif
            <div class="card-body">
                <h5 class="card-header"><strong>{{ $post->title }}</strong></h5>
                <h5 class="card-title">Creator: {{ $post->creator_name }}</h5>
                <p class="card-text">{{ $post->content }}</p>
                <p class="card-text">{{ $post->slug }}</p>

            </div>
        </div>
    @endforeach
</div>
@endsection
