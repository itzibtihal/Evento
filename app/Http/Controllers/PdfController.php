<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{

    public function downloadInvoice($booking_id)
{
    $booking = Booking::with(['event', 'user'])->findOrFail($booking_id);
    $organizer = $booking->event->organizer;

    $user = $booking->user;
    $ticketPrice = $booking->event->ticket_price;

    $bookedEvents = [$booking->event];

    $data = [
        'title' => 'Invoice',
        'date' => optional($booking->created_at)->format('m/d/Y') ?? now()->format('m/d/Y'),
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
