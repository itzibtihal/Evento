<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <a href="{{route('admin.index')}}" class="active">
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
            <h1>Dashboard</h1>
            <!-- Analyses -->
            <div class="analyse">
                <div class="sales">
                    <div class="status">
                        <div class="info">
                            <h3>TOTAL BOOKING</h3>
                            <h1>{{ $totalBookings }}</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+81%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="visits">
                    <div class="status">
                        <div class="info">
                            <h3>SITE USERS</h3>
                            <h1>{{ $siteUserCount }}</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>-48%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="searches">
                    <div class="status">
                        <div class="info">
                            <h3>TODAY'S EVENTS</h3>
                            <h1>{{ $eventsCreatedToday }}</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+21%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Analyses -->

            <!-- New Users Section -->
            <div class="new-users">
                <h2>New Booking</h2>
                <div class="user-list">
                    @foreach($lastBookedUsers as $booking)
                    <div class="user">
                        @if($booking->user->getMedia('profile_picture')->isNotEmpty())
                        <img src="{{ $booking->user->getFirstMediaUrl('profile_picture') }}" alt="{{ $booking->user->name }}">
                        @else
                        <img src="{{ asset('assets/images/avatar.jpg') }}" alt="{{ $booking->user->name }}">
                        @endif
                        <h2>{{ $booking->user->name }}</h2>
                        <p>{{ $booking->created_at->diffForHumans() }}</p>
                    </div>
                    @endforeach
                    <div class="user">
                        <img src="{{ asset('assets/images/plus.png') }}">
                        <h2>More</h2>
                        <p> <a href="{{route('admin.users.booking')}}">BOOKING</a></p>
                    </div>
                </div>
            </div>
            <!-- End of New Users Section -->

            <!-- Recent Orders Table -->
            <div class="recent-orders">
                <h1>User Registrations</h1>

                <div class="chart-container">
                    <canvas id="empGender" width="500" height="300"></canvas>
                    <canvas id="userAge" width="500" height="300"></canvas>
                </div>
            </div>

            <script>
                $(function() {

                    // GENDER CHART
                    var genderData = <?php echo json_encode($genderData); ?>;
                    var genderChartCanvas = $('#empGender').get(0).getContext('2d');
                    var genderChartData = {
                        labels: genderData.gender_label,
                        datasets: [{
                            data: genderData.gender_data,
                            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
                            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
                            borderWidth: 1,
                        }, ],
                    };
                    var genderOptions = {
                        responsive: false,
                        maintainAspectRatio: false,
                        cutoutPercentage: 80,
                        tooltips: {
                            callbacks: {
                                label: (tooltipItem, data) => {
                                    var value = data.datasets[0].data[tooltipItem.index];
                                    var total = data.datasets[0].data.reduce((a, b) => a + b, 0);
                                    var pct = 100 / total * value;
                                    var pctRounded = Math.round(pct * 10) / 10;
                                    return value + ' (' + pctRounded + '%)';
                                },
                            },
                        },
                    };
                    var genderChart = new Chart(genderChartCanvas, {
                        type: 'doughnut',
                        data: genderChartData,
                        options: genderOptions,
                    });

                    // AGE CHART
                    var ageData = <?php echo json_encode($ageData); ?>;
                    var ageChartCanvas = $('#userAge').get(0).getContext('2d');
                    var ageChartData = {
                        labels: ageData.age_label,
                        datasets: [{
                            data: ageData.age_data,
                            backgroundColor: ['#f56954', '#00a65a'],
                            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
                            borderWidth: 1,
                        }, ],
                    };
                    var ageOptions = {
                        responsive: false,
                        maintainAspectRatio: false,
                        cutoutPercentage: 80,
                        tooltips: {
                            callbacks: {
                                label: (tooltipItem, data) => {
                                    var value = data.datasets[0].data[tooltipItem.index];
                                    var total = data.datasets[0].data.reduce((a, b) => a + b, 0);
                                    var pct = 100 / total * value;
                                    var pctRounded = Math.round(pct * 10) / 10;
                                    return value + ' (' + pctRounded + '%)';
                                },
                            },
                        },
                    };
                    var ageChart = new Chart(ageChartCanvas, {
                        type: 'doughnut',
                        data: ageChartData,
                        options: ageOptions,
                    });
                });

                var genderData = <?php echo json_encode($genderData); ?>;
                var ageData = <?php echo json_encode($ageData); ?>;
                console.log('Script Executed');
            </script>




            <!-- End of Recent Orders -->

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