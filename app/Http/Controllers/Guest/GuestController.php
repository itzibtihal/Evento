<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        

        return view('guest.events.details', compact('event'));
    }

    public function event(Request $request)
{
    $categories = Category::all();
    $selectedCategoryId = $request->input('categoryFilter', 'all');
    $selectedMonth = $request->input('monthFilter', 'all');
    $selectedPriceFilter = $request->input('priceFilter', 'all');
    $searchTitle = $request->input('searchTitle');

    $eventsQuery = Event::query();

    // Apply filters
    if ($selectedCategoryId !== 'all') {
        $eventsQuery->where('category_id', $selectedCategoryId);
    }

    if ($selectedMonth !== 'all') {
        $eventsQuery->whereMonth('date', '=', date('m', strtotime($selectedMonth)));
    }

    if ($selectedPriceFilter !== 'all') {
        $priceRanges = [
            '0-50' => [0, 50],
            '50-100' => [50, 100],
            'up-to-100' => [100, PHP_INT_MAX], // Adjust the upper limit as needed
        ];

        $eventsQuery->whereBetween('ticket_price', $priceRanges[$selectedPriceFilter]);
    }

    // Search by title
    if ($searchTitle) {
        $eventsQuery->where('title', 'like', '%' . $searchTitle . '%');
    }

    // Fetch filtered events
    $events = $eventsQuery->where('verified', 'yes')
        ->orderByDesc('created_at')
        ->paginate(6);

    return view('guest.events.index', compact('events', 'categories'));
}

    public function createBooking(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);
    
        $event = Event::findOrFail($request->event_id);
        $user = auth()->user();
    
        // Check if the user has already booked this event
        $existingBooking = Booking::where('event_id', $event->id)
            ->where('user_id', $user->id)
            ->first();

            $eventDateTime = Carbon::parse($event->date . ' ' . $event->hour);

    // Check if the event date and time are in the past
    if (now()->gt($eventDateTime)) {
        return response()->json(['error' => 'Event date and time are in the past.']);
    }


    

        if ($existingBooking) {
            return response()->json(['error' => 'You have already booked a ticket for this event.']);
        }
    
        // Set the initial status and ticket number based on the event status
        $status = ($event->status_event === 'auto-accepted') ? 'confirmed' : 'waiting';
    
        // Ensure available_tickets is greater than 0 for auto-confirmed events
        if ($event->status_event === 'auto-accepted' && $event->available_tickets <= 0) {
            return response()->json(['error' => 'Tickets are sold out.']);
        }
    
        $ticketNumber = ($event->status_event === 'auto-accepted') ? $event->available_tickets : 0;
    
        // Create a new booking
        Booking::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'ticket_number' => $ticketNumber,
            'status' => $status,
        ]);
    
        // Update available_tickets based on the event status
        if ($event->status_event === 'auto-accepted') {
            $event->decrement('available_tickets');
        }
    
        // You can return a response if needed
        return response()->json(['message' => 'Booking created successfully']);
    }
    


}
