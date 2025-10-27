@extends('layouts.app')

@section('title', isset($event) ? $event['name'] : 'Event Details')

@section('content')
    @isset($message)
        <p class="error">{{ $message }}</p>
    @endisset

    @isset($event)
        <h2>{{ $event['name'] }}</h2>
        <p><strong>Date:</strong> {{ $event['date'] }}</p>
        <p><strong>Location:</strong> {{ $event['location'] }}</p>
        <p><strong>Description:</strong> {{ $event['description'] }}</p>
        <p><strong>Status:</strong>
            @if($event['status'] === 'Upcoming')
                <span class="status-upcoming">Upcoming</span>
            @elseif($event['status'] === 'Ongoing')
                <span class="status-ongoing">Ongoing</span>
            @else
                <span class="status-completed">Completed</span>
            @endif
        </p>
    @else
        <p>No event data to show.</p>
    @endisset
@endsection
