<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title> Dashboard | Evento</title>

    <style>
        .recent-orders {
            text-align: center;
        }

        .chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            /* Adjust the gap between charts as needed */
            margin-top: 20px;
            /* Adjust the top margin as needed */
        }

        canvas {
            border-radius: 50%;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Sidebar Section -->
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
                <a href="{{route('organizer.index')}}" class="{{ request()->routeIs('organizer.index') ? 'active' : '' }}">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>My Profile</h3>
                </a>

                <a href="{{ route('organizer.event.index') }}" class="{{ request()->routeIs('organizer.event.index') ? 'active' : '' }}">
                    <span class="material-icons-sharp">
                        inventory
                    </span>
                    <h3>Events</h3>
                </a>

                <a href="{{route('organizer.events.create')}}">
                    <span class="material-icons-sharp">
                        add_circle_outline
                    </span>
                    <h3>New Event</h3>
                   
                </a>

                <a href="{{route('organizer.events.pending')}}" class="{{ request()->routeIs('organizer.events.pending') ? 'active' : '' }}">
                    <span class="material-icons-sharp">
                        report_gmailerrorred
                    </span>
                    <h3>Pending EVT</h3>
                </a>


                <a href="{{route('organizer.confirmed-bookings.index')}}" class="{{ request()->routeIs('organizer.confirmed-bookings.index') ? 'active' : '' }}">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>Booking</h3>
                </a>

                <a href="{{route('list.bookings')}}" class="{{ request()->routeIs('list.bookings') ? 'active' : '' }}">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3> Pend Booking</h3>
                </a>

                

                
                
                
                
               
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->

        <main>
            @yield('main-content')
        </main>
        <!-- End of Main Content -->

        <!-- Right Section -->
        <div class="right-section">
            @yield('right-section')
        </div>

    </div>

    <script src="{{ asset('assets/js/index.js') }}"></script>
</body>

</html>
