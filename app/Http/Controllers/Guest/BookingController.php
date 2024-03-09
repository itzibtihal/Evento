<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {   
         // Assuming you're using the currently authenticated user
    $user = auth()->user();

    // Fetch the user's bookings with related event information
    $userBookings = Booking::with('event')->where('user_id', $user->id)->get();

        return view('guest.booking',compact('userBookings'));
    }

   


}
