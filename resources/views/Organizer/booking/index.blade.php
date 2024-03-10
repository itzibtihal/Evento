@extends('layouts.navbar')


@section('main-content')
<h1>Booking</h1>
           <!-- Analyses -->

           
           <div class="recent-orders">
            <h2> See All </h2>
            
            <table>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Ticket ID</th>
                        <th>Created at</th>
                        <th>Available Tickets</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
    @foreach ($confirmedBookings as $booking)
        <tr>
            <td>
                {{ $booking->user->name }}

                <!-- Display user image -->
                @if($booking->user->getMedia('profile_picture')->isNotEmpty())
                    <img src="{{ $booking->user->getFirstMediaUrl('profile_picture') }}" alt="{{ $booking->user->name }}" style="width: 40px; border-radius: 50%;">
                @else
                    <img src="{{ asset('assets/images/avatar.jpg') }}" alt="{{ $booking->user->name }}" style="width: 40px; border-radius: 50%;">
                @endif
            </td>
            <td>{{ $booking->event->title }}</td>
            <td>{{ $booking->event->date }}</td>
            <td>{{ $booking->ticket_number}}</td>
            <td>{{ $booking->created_at}}</td>
            <td>{{ $booking->event->available_tickets }}</td>
            <td>
                <!-- Add any additional actions or buttons as needed -->
            </td>
        </tr>
    @endforeach
</tbody>
            </table>
            <div>
                <div class="pagination">
                    {{ $confirmedBookings->links() }}
                </div>
            </div>
        </div>
          
   

@endsection

@section('right-section')
<div class="right-section">
    <div class="nav">
        <button id="menu-btn">
            <span class="material-icons-sharp">
                menu
            </span>
        </button>
        <div class="dark-mode">
            <span class="material-icons-sharp active">
                light_mode
            </span>
            <span class="material-icons-sharp">
                dark_mode
            </span>
        </div>

        <div class="profile">
            <div class="info">
                <p>Hey, <b>{{Auth::user()->name}}</b></p>
                <small class="text-muted">{{ Auth::user()->roles()->first()->name }}</small>
            </div>
            <div class="profile-photo">
                <img src="{{ asset('assets/images/profile-1.jpg') }}">
            </div>
        </div>

    </div>
    <!-- End of Nav -->

    <div class="user-profile">
        <div class="logo">
            <img src="{{ asset('assets/images/logo-envent.png') }}" id="logo-image">
            <h2>EVENTO</h2>
            <p>Event Booking</p>
        </div>
    </div>

    <div class="reminders">
        <div class="header">
            <h2>Reminders</h2>
            <span class="material-icons-sharp">
                notifications_none
            </span>
        </div>

        <div class="notification">
            <div class="icon">
                <span class="material-icons-sharp">
                    volume_up
                </span>
            </div>
            <div class="content">
                <div class="info">
                    <h3>Workshop</h3>
                    <small class="text_muted">
                        08:00 AM - 12:00 PM
                    </small>
                </div>
                <span class="material-icons-sharp">
                    more_vert
                </span>
            </div>
        </div>

        <div class="notification deactive">
            <div class="icon">
                <span class="material-icons-sharp">
                    edit
                </span>
            </div>
            <div class="content">
                <div class="info">
                    <h3>Workshop</h3>
                    <small class="text_muted">
                        08:00 AM - 12:00 PM
                    </small>
                </div>
                <span class="material-icons-sharp">
                    more_vert
                </span>
            </div>
        </div>

        <div class="notification add-reminder">
            <div>
                <span class="material-icons-sharp">
                    add
                </span>
                <h3>Add Reminder</h3>
            </div>
        </div>

    </div>

</div>

@endsection