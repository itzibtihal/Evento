<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MBookingController extends Controller
{
    
    public function listConfirmedBookings()
    {
        $user = Auth::user();

    // Retrieve confirmed bookings for events created by the user
    $confirmedBookings = Booking::whereHas('event', function ($query) use ($user) {
            $query->where('created_by', $user->id);
        })
        ->where('status', 'confirmed')
        ->with('event')
        ->paginate(10);
        
    
        return view('organizer.booking.index', compact('confirmedBookings'));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'bookingId' => 'required|exists:bookings,id',
            'status' => 'required|in:confirmed,waiting,rejected',
            'reason' => 'nullable|string|max:255',
        ]);

        $booking = Booking::findOrFail($request->bookingId);

        $booking->status = $request->status;

        if ($request->status === 'rejected') {
            $booking->reason_of_reject = $request->reason;
        } else {
            $booking->reason_of_reject = null;
        }

        $booking->save();

        return response()->json(['message' => 'Booking status updated successfully']);
    }

    public function listBookings()
    {
        $user = Auth::user(); 

        $bookings = Booking::with(['user', 'event'])
            ->whereHas('event', function ($query) use ($user) {
                
                $query->where('created_by', $user->id);
            })
            ->whereIn('status', ['waiting', 'rejected'])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('organizer.booking.pending', compact('bookings'));
    }
}
