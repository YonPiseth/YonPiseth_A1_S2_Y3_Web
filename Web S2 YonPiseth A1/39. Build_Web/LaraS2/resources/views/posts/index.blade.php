@extends('layouts.custom')

@section('title', 'Posts Listing')

@section('content')
<div class="container-fluid d-flex my-2">
    <h1>All Posts</h1>
    <a class="btn btn-primary ms-auto mt-3" href="{{ route('posts.create') }}">Create New</a>
</div>

    <table class="table table-responsive table-striped">
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th></th>
        </tr>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>{{ Str::limit($post->body, 100) }}</td>
            <td>
                <a class="btn btn-primary w-25" href="{{ route('posts.show', $post) }}">View</a>
                <a class="btn btn-primary w-25" href="{{ route('posts.edit', $post) }}">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-primary w-25" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        @empty
            <tr>
                <td colspan="3">No posts yet.</td>
            </tr>
        @endforelse
    </table>
@endsection
