@extends('layout')

@section('content')
<a href="{{ route('posts.index') }}" class="text-blue-500">&larr; Back</a>

<h1 class="text-3xl font-bold mt-4">{{ $post->title }}</h1>
<p class="text-gray-600 mt-2">Categories: 
    @foreach($post->categories as $category)
        <span class="bg-gray-200 px-2 rounded">{{ $category->name }}</span>
    @endforeach
</p>

<div class="mt-6 text-lg border-b pb-6">
    {{ $post->body }}
</div>

<h3 class="text-xl font-bold mt-6">Comments</h3>
@forelse($post->comments as $comment)
    <div class="bg-gray-50 p-3 mt-2 rounded">
        <p>{{ $comment->content }}</p>
        <small class="text-gray-500">- {{ $comment->author_name ?? 'Anonymous' }}</small>
    </div>
@empty
    <p class="text-gray-500 mt-2">No comments yet.</p>
@endforelse
@endsection