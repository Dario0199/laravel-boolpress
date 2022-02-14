@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Edit {{ $post->title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label class="form-label" for="title" >Title</label>
                <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $post->title) }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="content" >Content</label>
                <textarea class="form-control" name="content" id="content" rows="10">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value="">Uncategorizated</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" 
                            @if ($category->id == old('category_id', $post->category_id)) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <h3>Tags</h3>
                @foreach ($tags as $tag)
                    <span class="d-inline-block mr-3">
                        <input type="checkbox" name="tags[]" id="tag{{ $loop->iteration }}" value="{{ $tag->id }}"
                        @if ($errors->any() && in_array($tag->id, old('tags'))) 
                            checked 
                        @elseif (!$errors->any() && $post->tags->contains($tag->id))
                            checked
                        @endif>
                        <label for="tag{{ $loop->iteration }}">
                            {{ $tag->name }}
                        </label>
                    </span>
                @endforeach
                @error('tags')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label class="form-label" for="'cover">Image</label>
                   <figure class="mb-3">
                        @if ($post->cover)
                            <img width="200" src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
                        @endif
                    </figure>
                    <input class="form-control-file" type="file" name="cover" id="cover">
                    @error('cover')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Edit post</button>
        </form>
    </div>    
@endsection