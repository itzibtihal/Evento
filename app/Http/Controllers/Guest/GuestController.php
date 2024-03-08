<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;

class GuestController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $verifiedEvents = Event::where('verified', 'yes')
            ->where('date', '>=', $today)
            ->orderBy('date')
            ->take(3)
            ->get();

            $today = Carbon::today();

           
            $todaysEvents = Event::whereDate('date', $today)
                ->where('available_tickets', '>', 0)
                ->orderBy('available_tickets')
                ->take(3)
                ->get();
        
        return view('guest.index', compact('verifiedEvents','todaysEvents'));
    }

    public function show(Event $event)
    {
        $events = Event::where('verified', 'yes')
        ->orderByDesc('created_at')
        ->paginate(6);

        return view('guest.events.details', compact('events'));
    }

    public function events()
    {
        $events = Event::where('verified', 'yes')
        ->orderByDesc('created_at')
        ->paginate(6);

        return view('guest.events.index', compact('events'));
    }


}
