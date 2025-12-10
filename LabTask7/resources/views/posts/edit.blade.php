@extends('layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Post</h1>

<form action="{{ route('posts.update', $post) }}" method="POST">
    @csrf @method('PUT')
    
    <div class="mb-4">
        <label class="block font-bold">Title</label>
        <input type="text" name="title" value="{{ $post->title }}" class="w-full border p-2 rounded">
    </div>
    
    <div class="mb-4">
        <label class="block font-bold">Body</label>
        <textarea name="body" class="w-full border p-2 rounded" rows="4">{{ $post->body }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block font-bold">Categories</label>
        <select name="categories[]" multiple class="w-full border p-2 rounded">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" 
                    {{ $post->categories->contains($category->id) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="bg-blue-500 text-white px-4 py-2 rounded">Update Post</button>
</form>
@endsection