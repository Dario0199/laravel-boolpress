@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>posts</h1>
        
        @if (session('deleted'))
            <div class="alert alert-success alert-dismissible">
                <strong>{{ session('deleted') }}</strong> deleted!
            </div>
        @endif

        @if ($posts->isEmpty())
            <p>No post found <a href="{{ route('admin.posts.create') }}">Create a new post </a> </p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>title</th>
                        <th>Category</th>
                        <th colspan="3">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>
                                @if($post->category)
                                    <a href="{{ route('admin.category', $post->category->id) }}">
                                        {{$post->category->name}}
                                    </a> 
                                @else 
                                    Uncategorized 
                                @endif 
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">Show</a>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}"method="post"0>
                                    @csrf
                                    @method('delete')

                                    <input class="btn btn-danger" type="submit" value="Delete"/>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>    
@endsection