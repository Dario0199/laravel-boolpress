@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">{{ $category->name }}</h1>

        @foreach ($category->posts as $post)
            <article class="mb-3">
                <h2>{{ $post->title }}</h2>
                <a href="{{ route('admin.posts.show', $post->slug) }}">Show</a>
                <a href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                <hr>
            </article>
        @endforeach
    </div>    
@endsection