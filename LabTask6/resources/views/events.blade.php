@extends('layouts.app')

@section('title', 'All Events')

@section('content')
    <h2>All Events</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    @isset($events)
        @empty($events)
            <p>No events available.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>{{ $event['name'] }}</td>
                            <td>{{ $event['date'] }}</td>
                            <td>{{ $event['location'] }}</td>
                            <td>
                                @if($event['status'] === 'Upcoming')
                                    <span class="status-upcoming">Upcoming</span>
                                @elseif($event['status'] === 'Ongoing')
                                    <span class="status-ongoing">Ongoing</span>
                                @else
                                    <span class="status-completed">Completed</span>
                                @endif
                            </td>
                            <td style="white-space:nowrap;">
                                <a href="{{ url('/events/'.$event['id']) }}">View</a>

                                <!-- Delete form -->
                                <form method="POST" action="{{ route('events.delete', ['id' => $event['id']]) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" style="margin-left:8px; background:none; border:1px solid #ccc; padding:4px 8px; border-radius:4px; cursor:pointer;">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endempty
    @endisset
@endsection
