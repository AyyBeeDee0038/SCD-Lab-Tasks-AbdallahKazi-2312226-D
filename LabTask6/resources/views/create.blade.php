@extends('layouts.app')

@section('title', 'Create Event')

@push('styles')
    <style>
        form { margin-top: 10px; }
        label { display:block; margin-top:8px; }
        input[type="text"], input[type="date"], textarea { width:100%; padding:8px; margin-top:4px; box-sizing:border-box; }
        button { margin-top:10px; padding:8px 12px; border:none; border-radius:4px; cursor:pointer; }
    </style>
@endpush

@section('content')
    <h2>Create a New Event</h2>

    <!-- show error from session (redirected) -->
    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('events.store') }}">
        @csrf
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="{{ old('title', '') }}">

        <label for="date">Date</label>
        <input type="date" id="date" name="date" value="{{ old('date', '') }}">

        <label for="location">Location</label>
        <input type="text" id="location" name="location" value="{{ old('location', '') }}">

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4">{{ old('description', '') }}</textarea>

        <button type="submit">Submit</button>
    </form>
@endsection
