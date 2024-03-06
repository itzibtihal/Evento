<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $siteUserCount = User::count();
        $totalBookings = Booking::count();
        $eventsCreatedToday = Event::whereDate('created_at', Carbon::today())->count();
        
        $lastBookedUsers = Booking::with(['user', 'event'])
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();

        return view('admin.index', compact('siteUserCount','totalBookings','eventsCreatedToday','lastBookedUsers')); 
    }

    public function booking()
{
   
    $bookings = Booking::all();
    return view('admin.booking.index', compact('bookings'));
}

    
}

