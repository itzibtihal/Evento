<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{


    public function index()
    {
        $booking_id = 1;
        $booking = Booking::with(['event', 'user'])->findOrFail($booking_id);
        $organizer = $booking->event->organizer;

        // Fetch user details from the booking
        $user = $booking->user;
        $ticketPrice = $booking->event->ticket_price;

        $bookedEvents = [$booking->event];

        $data = [
            'title' => 'Invoice',
            'date' => $booking->created_at->format('m/d/Y'), 
            'invoiceNo' => $booking->id, 
            'userName' => $user->name,
            'userEmail' => $user->email,
            'userAge' => $user->age,
            'organizerName' => $organizer->name,
            'organizationName' => $organizer->organization,
            'organizerEmail' => $organizer->email,
            'ticketPrice' => $ticketPrice,
            'bookedEvents' => $bookedEvents,
        ];

        $html = view('pdf.invoice', $data)->render();
        return $html;
    }
}
