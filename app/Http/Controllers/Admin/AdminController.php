<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        $genderRecords = User::selectRaw('COUNT(*) as count, gender, IF(gender = 0, "Female", "Male") as gender_label')
        ->groupBy('gender')
        ->get();

    $genderData = [
        'gender_label' => $genderRecords->pluck('gender_label')->toArray(),
        'gender_data' => $genderRecords->pluck('count')->toArray(),
    ];

    $ageRecord = User::selectRaw('count(id) as count, if (age > 18, "Over 18", "Under 18") as age_category')
        ->groupBy('age_category')
        ->get();

    $ageData = [];
    
    foreach ($ageRecord as $row) {
        $ageData['age_label'][] = $row->age_category;
        $ageData['age_data'][] = (int) $row->count;
    }

    $ageData['age_chart_data'] = json_encode($ageData);

        return view('admin.index', compact('siteUserCount','totalBookings','eventsCreatedToday','lastBookedUsers','genderData','ageData')); 
    }

    public function booking()
{
   
    $bookings = Booking::all();
    return view('admin.booking.index', compact('bookings'));
}




    
}

