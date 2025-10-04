<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Auth::user()->events()->latest();
        
        // Filter by status if provided
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        // Filter by upcoming events if requested
        if ($request->has('filter') && $request->filter === 'upcoming') {
            $query->where('status', 'active')->where('event_date', '>', now());
        }
        
        $events = $query->paginate(10);
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date|after:now',
            'location' => 'required|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
        ]);

        // Force status to 'active' for new events
        $eventData = $request->all();
        $eventData['status'] = 'active';

        Auth::user()->events()->create($eventData);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // Check if user owns the event or is admin
        if ($event->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Access denied.');
        }

        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        // Check if user owns the event or is admin
        if ($event->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Access denied.');
        }

        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        // Check if user owns the event or is admin
        if ($event->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Access denied.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date|after:now',
            'location' => 'required|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'status' => 'required|in:active,cancelled,completed',
        ]);

        $event->update($request->all());

        // Redirect based on user role
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.events')->with('success', 'Event updated successfully.');
        }

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // Check if user owns the event or is admin
        if ($event->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Access denied.');
        }

        $event->delete();

        // Redirect based on user role
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.events')->with('success', 'Event deleted successfully.');
        }

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
