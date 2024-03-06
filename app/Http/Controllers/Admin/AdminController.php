<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $siteUserCount = User::count();
        return view('admin.index', compact('siteUserCount')); 
    }

    public function booking()
{
   
    $bookings = Booking::all();
    return view('admin.booking.index', compact('bookings'));
}

    
}

