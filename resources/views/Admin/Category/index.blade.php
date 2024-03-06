<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1;
            border-radius: 27px;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .modal input,
        .modal button {
            margin-bottom: 10px;
            padding: 8px;
        }

        .modal input {
            height: 30px;
            /* Add height */
            border: 1px solid black;
            /* Add border color */
            border-radius: 5px;
            /* Add border-radius */
            padding: 8px;
            margin-bottom: 10px;
        }

        .modal form {
            display: flex;
            flex-direction: column;
        }

        .modal-close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
    </style>
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

                <a href="{{route('admin.category.index')}}" class="active">
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
            <h1>Categories</h1>

            <div class="recent-orders">
                <h2>All Categories</h2>
                <a href="javascript:void(0);" onclick="openModal()">Add new Category</a>

                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Action</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td> <span>
                                    <a href="">
                                        <i class="fa-solid fa-pencil-alt" style="color: blue;"></i>
                                    </a>
                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" style="border: none; background: none; cursor: pointer;">
                                            <i class="fa-solid fa-trash" style="color: red;"></i>
                                        </button>
                                    </form>
                                </span>
                            </td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="overlay" id="overlay" onclick="closeModal()"></div>
            <div class="modal" id="modal">
                <!-- Your modal content goes here -->
                <h2>Add New Category</h2> <br>
                <form action="{{ route('admin.category.store') }}" method="post">
                    @csrf
                    <label for="category"> Category Name</label> <br>
                    <input type="text" name="name" id="" placeholder="Category ...."><br>
                    <button type="submit" onclick="closeModal()" style="border-radius: 10px;"> Submit</button>
                </form>

            </div>


            <div class="modal" id="edit-modal">
                <!-- Your edit modal content goes here -->
                <h2 id="edit-modal-title">Edit Category</h2> <br>
                <form id="edit-category-form" method="post">
                    @csrf
                    @method('put')
                    <label for="category"> Category Name</label> <br>
                    <input type="text" name="name" id="edit-category-name" placeholder="Category ...."><br>
                    <button type="submit" onclick="closeEditModal()" style="border-radius: 10px;"> Update</button>
                </form>
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
    <script>
        function openModal() {
            document.getElementById('modal').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }
    </script>
</body>

</html>