@extends('layouts.app')

@section('content')
<div class="container">
    @if($post->image)
        <img class="mt-3 mb-3" src="{{ asset('uploads/' . $post->image) }}" alt="Post image" width="250" height="250">
    @endif

    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @error('title')
        <div class="alert alert-warning" role="alert">
            {{ $message }}
        </div>
        @enderror

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" value="{{ old('title', $post->title) }}" name="title" placeholder="Enter title">
        </div>

        @error('content')
        <div class="alert alert-warning" role="alert">
            {{ $message }}
        </div>
        @enderror

        <div class="mb-3">
            <label for="content" class="form-label">Description</label>
            <textarea class="form-control" id="content" name="content" rows="3" placeholder="Enter description">{{ old('content', $post->content) }}</textarea>
        </div>


        @error('image')
        <div class="alert alert-warning" role="alert">
            {{ $message }}
        </div>
        @enderror

        <div class="form-group">
            <label for="formControlFile1">Add post image</label>
            <input type="file" class="form-control-file" name="image" id="formControlFile1">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
