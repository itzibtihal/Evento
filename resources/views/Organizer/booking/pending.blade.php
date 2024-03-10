@extends('layouts.navbar')


@section('main-content')
<h1> Waiting Confirmation Booking</h1>
           <!-- Analyses -->
           <div class="recent-orders">
            <h2>See All</h2>
        
            <table>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Ticket ID</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Created at</th>
                        <th>Status</th>
                        <th>Reason for Rejection</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
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
                            <td>{{ $booking->ticket_number }}</td>
                            <td>{{ $booking->user->age }}</td>
                            <td>
                                @if($booking->user->gender == 0)
                                    Female
                                @elseif($booking->user->gender == 1)
                                    Male
                                @else
                                    Other
                                @endif
                            </td>
                            <td>{{ $booking->created_at }}</td>
                            <td>
                                <select name="status" id="status{{ $booking->id }}">
                                    <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="waiting" {{ $booking->status === 'waiting' ? 'selected' : '' }}>Waiting</option>
                                    <option value="rejected" {{ $booking->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="reason" id="reason{{ $booking->id }}" value="{{ $booking->reason_of_reject }}">
                            </td>
                            <td>
                                <button onclick="updateStatus({{ $booking->id }})">Update</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        
            <div>
                <div class="pagination">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
        <script>
            function updateStatus(bookingId) {
                var status = $('#status' + bookingId).val();
                var reason = $('#reason' + bookingId).val();
        
                // Add CSRF token to headers
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
        
                // Perform AJAX request to update status and reason
                $.ajax({
                    url: '{{ route("update.booking.status") }}',

                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        bookingId: bookingId,
                        status: status,
                        reason: reason
                    },
                    success: function(response) {
                        // Handle success, if needed
                        console.log('Update successful:', response);
                    },
                    error: function(error) {
                        // Handle error, if needed
                        console.error('Update failed:', error);
                    }
                });
            }
        </script>
        
          
   

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