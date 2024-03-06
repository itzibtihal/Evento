<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title> Dashboard | ArtsyCollabs</title>
</head>

<body>

    <div class="container">
        <!-- Sidebar Section -->
        <aside>
            <div class="toggle">
                <div class="logo">
                <img src="{{ asset('assets/images/logo-envent.png') }}" id="logo-image">
                    <h2>EVEN<span class="danger">TO</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="{{route('admin.index')}}" >
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="{{route('admin.users.index')}}">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Evento Users</h3>
                </a>
                <a href="{{route('admin.organizer.index')}}" >
                    <span class="material-icons-sharp">
                        business
                    </span>
                    <h3>Organizer</h3>
                </a>
                <a href="{{route('admin.users.booking')}}" class="active">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>Booking</h3>
                </a>
                
                <!-- <a href="#">
                    <span class="material-icons-sharp">
                        mail_outline
                    </span>
                    <h3>Notif</h3>
                    <span class="message-count">27</span>
                </a> -->
                <a href="{{route('admin.category.index')}}" >
                    <span class="material-icons-sharp">
                        add_circle_outline
                    </span>
                    <h3>Categories</h3>
                    <!-- <span class="message-count">27</span> -->
                </a>

                <a href="{{route('admin.event.index')}}">
                    <span class="material-icons-sharp">
                        inventory
                    </span>
                    <h3>Events</h3>
                </a>
                <a href="{{route('admin.event.getUnverifiedEvents')}}">
                    <span class="material-icons-sharp">
                        report_gmailerrorred
                    </span>
                    <h3>Pending EVT</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        settings
                    </span>
                    <h3>Settings</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
            <h1>Booking</h1>
         
            <div class="recent-orders">
                <h2> See All </h2>
                
                <table>
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Event Name</th>
                            <th>Organizer Name</th>
                            <th>Ticket ID</th>
                            <th>Available Tickets</th>
                            <th></th>
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
                <td>{{ $booking->event->organizer->name }}</td>
                <td>{{ $booking->ticket_number}}</td>
                <td>{{ $booking->event->available_tickets }}</td>
                <td>
                    <!-- Add any additional actions or buttons as needed -->
                </td>
            </tr>
        @endforeach
    </tbody>
                </table>
            </div>

        </main>
        <!-- End of Main Content -->

        <!-- Right Section -->
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


    </div>

    
    <script src="{{ asset('assets/js/index.js') }}"></script>
</body>

</html>