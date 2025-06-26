@extends('layouts.custom')

@section('title', 'Create post')

@section('content')
    <h1>Create Post</h1>
    <form method="POST" action="{{ route('posts.store') }}" class="w-70 mx-auto">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" placeholder="Title" value="{{ old('title') }}" id="title" class="form-control">
            @error('title') <p>{{ $message }}</p> @enderror
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Content</label>
            <textarea name="body" id="body" class="form-control" placeholder="Body" id="body">{{ old('body') }}</textarea>
            @error('body') <p>{{ $message }}</p> @enderror
        </div>
        <button type="submit" id="submit" class="btn btn-primary form-control">Create</button>
    </form>
@endsection
