@extends('layouts.custom')

@section('title', 'Edit post')

@section('content')
    <h1>Edit Post</h1>
    <form method="POST" action="{{ route('posts.update', $post) }}" class="w-70 mx-auto">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" placeholder="Title">
            @error('title') <p>{{ $message }}</p> @enderror
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Content</label>
            <textarea class="form-control" id="body" name="body" rows="5" placeholder="Content">{{ old('body', $post->body) }}</textarea>
            @error('body') <p>{{ $message }}</p> @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100">Update</button>
    </form>
@endsection
