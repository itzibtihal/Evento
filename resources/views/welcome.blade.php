<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>EVENTO</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('assets/images/logo-envent.png')}}" rel="icon">


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->

    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">


    <!-- Template Main CSS File -->
    <link href="{{asset('assets/css/Welcome.css')}}" rel="stylesheet">
    <style>
        video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>


</head>

<body>

    <header id="header" class="fixed-top header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="index.html">EVENTO</a></h1>

            <nav id="navbar" class="navbar">
                <ul>
                    @guest
                    @if (Route::has('login'))
                    <li><a class="nav-link scrollto" href="{{ route('login') }}">Log In</a></li>
                    @endif
                    @if (Route::has('register'))
                    <li><a class="nav-link scrollto" href="{{ route('register') }}">Register</a></li>
                    @endif

                    @else
                    <li><a class="nav-link scrollto" href="{{ route('register') }}">{{Auth::user()->name}}</a></li>
                    @endguest
                </ul>

                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>


        </div>
    </header>


    <section id="hero">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

            <div class="carousel-inner" role="listbox">

                <!-- Slide 1 -->
                <!-- <div class="carousel-item active" style="background-image: url('https://wallpapercave.com/wp/wp7488244.jpg');">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animated fadeInDown">Welcome to <span>EVENTO</span></h2>
              <p class="animated fadeInUp">The BIGGEST Event Booking Platform .</p>
              <a href="#about" class="btn-get-started animated fadeInUp scrollto">Consult Our Events</a>
            </div>
          </div>
        </div> -->
                <!-- Slide 2 -->
                <!-- <div class="carousel-item" style="background-image: url('https://i.pinimg.com/originals/85/c0/6d/85c06d07b0dec2a9c3ed75ebec110f33.jpg')">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animated fadeInDown">Welcome to <span>EVENTO</span></h2>
              <p class="animated fadeInUp">The BIGGEST Event Booking Platform .</p>
              <a href="#about" class="btn-get-started animated fadeInUp scrollto">Consult Our Events</a>
            </div>
          </div>
        </div> -->


                <div class="">
                    <video autoplay loop muted>
                        <source src="{{asset('assets/event.mp4')}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="carousel-container">
                        <div class="container">
                            <h2 class="animated fadeInDown">Welcome to <span>EVENTO</span></h2>
                            <p class="animated fadeInUp">The BIGGEST Event Booking Platform .</p>
                            <a href="#about" class="btn-get-started animated fadeInUp scrollto">Consult Our Events <i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <script src="{{asset('asset/js/main.js')}}"></script>

</body>

</html>