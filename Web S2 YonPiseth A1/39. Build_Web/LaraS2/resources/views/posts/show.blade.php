@extends('layouts.custom')

@section('title', 'Show post')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
    <a href="{{ route('posts.index') }}" class="btn btn-primary w-100">Back</a>
@endsection
