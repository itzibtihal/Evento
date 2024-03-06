<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    
    public function index()
{
    $today = Carbon::today();

    $events = Event::where('verified', 'yes')
                   ->whereDate('date', '>=', $today)
                   ->orderBy('date')
                   ->get();
        return view('admin.events.index', compact('events'));
   
}

public function getUnverifiedEvents()
{
    $today = Carbon::today();

    $unverifiedEvents = Event::where('verified', '!=', 'yes')
                             ->whereDate('date', '>=', $today)
                             ->orderBy('date')
                             ->get();

    return view('admin.pending.index', compact('unverifiedEvents'));
}


 public function edit(Event $event)
    {
        return view('admin.editevent', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
    
        $request->validate([
            'verified' => 'required|in:yes,no',
        ]);
    
        // dd($request->all());
    
        $event->update([
            'verified' => $request->input('verified'), 
        ]);
    
        return redirect()->route('admin.event.getUnverifiedEvents')->with('success', 'Event updated successfully');
    }
    



}