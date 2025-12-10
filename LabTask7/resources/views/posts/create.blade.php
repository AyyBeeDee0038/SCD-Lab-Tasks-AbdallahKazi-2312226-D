@extends('layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Create Post</h1>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label class="block font-bold">Title</label>
        <input type="text" name="title" class="w-full border p-2 rounded">
    </div>
    
    <div class="mb-4">
        <label class="block font-bold">Body</label>
        <textarea name="body" class="w-full border p-2 rounded" rows="4"></textarea>
    </div>

    <div class="mb-4">
        <label class="block font-bold">Categories</label>
        <select name="categories[]" multiple class="w-full border p-2 rounded">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <small>Hold Ctrl/Cmd to select multiple</small>
    </div>

    <button class="bg-green-500 text-white px-4 py-2 rounded">Save Post</button>
</form>
@endsection