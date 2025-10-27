@extends('layouts.app')

@section('title', 'Event Submitted')

@section('content')
    <h2>Event Submitted Successfully</h2>

    @isset($submitted)
        <div class="success">Your event was received. Here is the submitted data:</div>

        <table>
            <tr><th>Title</th><td>{{ $submitted['name'] }}</td></tr>
            <tr><th>Date</th><td>{{ $submitted['date'] }}</td></tr>
            <tr><th>Location</th><td>{{ $submitted['location'] }}</td></tr>
            <tr><th>Description</th><td>{{ $submitted['description'] }}</td></tr>
            <tr><th>Status</th><td>
                @if($submitted['status'] === 'Upcoming')
                    <span class="status-upcoming">Upcoming</span>
                @elseif($submitted['status'] === 'Ongoing')
                    <span class="status-ongoing">Ongoing</span>
                @else
                    <span class="status-completed">Completed</span>
                @endif
            </td></tr>
        </table>
    @else
        <p>No submission data available.</p>
    @endisset
@endsection
