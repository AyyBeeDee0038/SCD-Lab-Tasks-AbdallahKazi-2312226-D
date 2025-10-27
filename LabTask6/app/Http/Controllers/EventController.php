<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class EventController extends Controller
{
    // Default events (used if session empty)
    private function defaultEvents()
    {
        return [
            1 => [
                'id' => 1,
                'name' => 'Community Meetup',
                'date' => '2025-11-01',
                'location' => 'City Hall',
                'description' => 'A meetup for local developers.',
                'status' => 'Upcoming',
            ],
            2 => [
                'id' => 2,
                'name' => 'Hackathon',
                'date' => '2025-10-25',
                'location' => 'Tech Park',
                'description' => '24-hour coding event.',
                'status' => 'Ongoing',
            ],
            3 => [
                'id' => 3,
                'name' => 'Charity Concert',
                'date' => '2025-09-10',
                'location' => 'Open Arena',
                'description' => 'Concert for a cause.',
                'status' => 'Completed',
            ],
        ];
    }

    // Helper: get events from session or defaults
    private function getEventsFromSession()
    {
        $events = session('events', null);
        if (!is_array($events)) {
            // initialize session with default events
            $events = $this->defaultEvents();
            session(['events' => $events]);
        }
        return $events;
    }

    // Helper: save events array back to session
    private function saveEventsToSession(array $events)
    {
        session(['events' => $events]);
    }

    // index() → list events
    public function index()
    {
        $events = $this->getEventsFromSession();
        // sort by id ascending (optional)
        ksort($events);
        return view('events', compact('events'));
    }

    // details($id) → show details
    public function details($id = null)
    {
        $events = $this->getEventsFromSession();

        if (!isset($id) || !isset($events[$id])) {
            return view('details')->with('message', 'Event not found or id not provided.');
        }

        $event = $events[$id];

        return view('details', compact('event'));
    }

    // create() → show form
    public function create()
    {
        // create view reads old() values and session('error') if present
        return view('create');
    }

    // store() → handle POST form, validate fields
    public function store(Request $request)
    {
        // Simple trim validation
        $title = trim($request->input('title', ''));
        $date = trim($request->input('date', ''));
        $location = trim($request->input('location', ''));
        $description = trim($request->input('description', ''));

        if ($title === '' || $date === '' || $location === '' || $description === '') {
            // Redirect back to form with old input and error message
            return redirect()->route('events.create')
                             ->withInput()
                             ->with('error', 'Please fill all fields');
        }

        // Prepare submitted data and determine status
        $timestamp = strtotime($date);
        $now = time();
        $status = ($timestamp > $now) ? 'Upcoming' : (($timestamp < $now) ? 'Completed' : 'Ongoing');

        $events = $this->getEventsFromSession();

        // generate new id: max existing id + 1
        $newId = empty($events) ? 1 : (max(array_keys($events)) + 1);

        $newEvent = [
            'id' => $newId,
            'name' => $title,
            'date' => $date,
            'location' => $location,
            'description' => $description,
            'status' => $status,
        ];

        // store into session
        $events[$newId] = $newEvent;
        $this->saveEventsToSession($events);

        // flash success and show response
        session()->flash('success', 'Event created successfully.');
        return view('response', ['submitted' => $newEvent]);
    }

    // destroy() → delete an event by id (POST)
    public function destroy($id)
    {
        $events = $this->getEventsFromSession();

        if (isset($events[$id])) {
            unset($events[$id]);
            $this->saveEventsToSession($events);
            session()->flash('success', 'Event deleted.');
        } else {
            session()->flash('error', 'Event not found.');
        }

        return redirect()->route('events.index');
    }
}
