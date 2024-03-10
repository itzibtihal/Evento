<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyEventController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $events = Event::where('created_by', Auth::id())->where('verified', 'yes')->get();
        

        return view('organizer.events.index',compact('events')); 
    }

    public function pendingEvents()
{
    
    $pendingEvents = Event::where('created_by', Auth::id())->where('verified', 'no')->get();

    return view('organizer.events.pending', compact('pendingEvents'));
}

public function create()
{
    $categories = Category::all();
    return view('organizer.events.create', compact('categories'));
}

public function store(EventStoreRequest $request)
{
    
    $event = Event::create($request->except('event_banner'));

    
    if ($request->hasFile('event_banner')) {
        $event->addMediaFromRequest('event_banner')
            ->toMediaCollection('media/events' , 'media_events');
    }

    return redirect()->route('organizer.events.pending')->with('success', 'Event created successfully!');
}

public function edit(Event $event)
{
    $categories = Category::all();
    return view('organizer.events.edit', compact('event', 'categories'));
}

public function update(EventUpdateRequest $request, Event $event)
{
    $event->update($request->except('event_banner'));

    if ($request->hasFile('event_banner')) {
        $event->addMediaFromRequest('event_banner')
            ->toMediaCollection('event_images');
    }

    return redirect()->route('organizer.events.pending')->with('success', 'Event updated successfully!');
}

public function deleteEvent(Event $event)
{
    
    $event->delete();

    return redirect()->route('organizer.events.pending')->with('success', 'Event deleted successfully.');
}
}
