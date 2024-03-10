<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $user = auth()->user();
        
        $eventIdsCreatedByUser = Event::where('created_by', $user->id)->pluck('id');

       
        $totalBookings = Booking::whereIn('event_id', $eventIdsCreatedByUser)->count();
        
        $myEventsCount = Event::where('created_by', $user->id)->count();
        
        $pendingBookingsCount = Booking::whereHas('event', function ($query) use ($user) {
                $query->where('created_by', $user->id);
            })
            ->where('status', 'waiting')
            ->count();

            $user = Auth::user();

            // Retrieve the last 5 confirmed bookings for events created by the user
            $Bookings = Booking::whereHas('event', function ($query) use ($user) {
                    $query->where('created_by', $user->id);
                })
                
                ->with('event')
                ->latest()  // Order by the latest bookings
                ->limit(5)  // Limit to the last 5 bookings
                ->get();

        return view('organizer.index',compact('totalBookings','myEventsCount','pendingBookingsCount','Bookings')); 
    }
}
