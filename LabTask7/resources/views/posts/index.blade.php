@extends('layout')

@section('content')
<div class="flex justify-between mb-6">
    <h1 class="text-2xl font-bold">All Posts</h1>
    <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create New</a>
</div>

@foreach($posts as $post)
    <div class="border-b py-4">
        <h2 class="text-xl font-bold">
            <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-500">{{ $post->title }}</a>
        </h2>
        <p class="text-gray-600 text-sm">
            By: {{ $post->user->name ?? 'Unknown' }} | 
            Comments: {{ $post->comments_count }}
        </p>
        <div class="mt-2">
            @foreach($post->categories as $category)
                <span class="bg-gray-200 text-xs px-2 py-1 rounded">{{ $category->name }}</span>
            @endforeach
        </div>
        
        <div class="mt-2 flex gap-2">
            <a href="{{ route('posts.edit', $post) }}" class="text-yellow-600">Edit</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-600">Delete</button>
            </form>
        </div>
    </div>
@endforeach
@endsection