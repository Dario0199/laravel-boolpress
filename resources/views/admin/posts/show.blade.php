@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">{{ $post->title }}</h1>

        <div class="mb-3">
            <p>Category: @if($post->category){{$post->category->name}} @else Uncategorized @endif</p>
            <a class="btn btn-success" href="{{ route('admin.posts.edit', $post->id) }}">Edit this post</a>
            <a class="btn btn-warning" href="{{ route('admin.posts.index') }}">Back to archive</a>
        </div>

        <div class="row">
            <div class="col-md-6">
                {!! $post->content !!}
            </div>
            <div class="col-md-6">
                IMAGE
            </div>
        </div>
        
        @if (!$post->tags->isEmpty())
            <h3>Tags:</h3>
            @foreach ($post->tags as $tag)
                <p class="badge badge-primary">{{ $tag->name }}</p>
            @endforeach
        @else
            <p>No tags for this post</p>
        @endif
    </div>    
@endsection