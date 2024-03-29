<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title> Dashboard | Evento</title>
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
                <a href="{{route('admin.index')}}">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="{{route('admin.users.index')}}" class="active">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Evento Users</h3>
                </a>
                <a href="{{route('admin.organizer.index')}}">
                    <span class="material-icons-sharp">
                        business
                    </span>
                    <h3>Organizer</h3>
                </a>
                <a href="{{route('admin.users.booking')}}">
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
                <a href="{{route('admin.category.index')}}">
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
            <h1>Users</h1>
            <!-- last 4 Users Section -->
            <div class="new-users">
                <h2>Blocked Users</h2>
                <div class="user-list">
                    @foreach($blockedUsers as $user)
                    <div class="user">
                        @if($user->getMedia('profile_picture')->isNotEmpty())
                        <img src="{{ $user->getFirstMediaUrl('profile_picture') }}" alt="{{ $user->name }}">
                        @else
                        <img src="{{ asset('assets/images/avatar.jpg') }}" alt="{{ $user->name }}">
                        @endif
                        <h2>{{ $user->name }}</h2>
                        <p>{{ $user->updated_at->diffForHumans() }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- End of 4 Users Section -->

            <div class="recent-orders">
                <h2>All Users</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Profile</th>
                            <th>Full Name</th>
                            <th>Age</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                @if($user->getMedia('profile_picture')->isNotEmpty())
                                <img src="{{ $user->getFirstMediaUrl('profile_picture') }}" alt="{{ $user->name }}">
                                @else
                                <img src="{{ asset('assets/images/avatar.jpg') }}" style="width: 40px;" alt="{{ $user->name }}">
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->age ?? 'N/A' }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                            <td>
                                <select name="status" id="status{{ $user->id }}">
                                    <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Active</option>
                                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Blocked</option>
                                </select>
                            </td>
                            </td>

                            <td>
                                <button onclick="updateStatus({{ $user->id }})">Update</button>


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <script>
                    function updateStatus(userId) {
                        var status = $('#status' + userId).val();

                        $.ajax({
                            url: '{{ route("update.user.status") }}',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                userId: userId,
                                status: status
                            },
                            success: function(response) {
                                console.log('Update successful:', response);

                                // Add a callback function to update the UI
                                handleUpdateSuccess(userId, status);
                            },
                            error: function(error) {
                                console.error('Update failed:', error);
                            }
                        });
                    }

                    // Callback function to update the UI
                    function handleUpdateSuccess(userId, status) {
                        console.log('Updating UI for user:', userId, 'with status:', status);

                        // You can add code here to update the UI as needed
                        // For example, change the text, color, or any other relevant changes
                    }
                </script>



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