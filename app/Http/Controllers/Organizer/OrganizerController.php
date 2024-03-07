<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;


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

        return view('organizer.index',compact('totalBookings','myEventsCount','pendingBookingsCount')); 
    }
}
