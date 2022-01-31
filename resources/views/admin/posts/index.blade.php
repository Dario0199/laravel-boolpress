@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>posts</h1>
        
        @if ($posts->isEmpty())
            <p>No post found <a href="{{ route('admin.posts.create') }}">Create a new post </a> </p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>title</th>
                        <th colspan="3">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>SHOW</td>
                            <td>EDIT</td>
                            <td>DELETE</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>    
@endsection