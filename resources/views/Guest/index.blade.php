<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Tooplate">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <title>EVENTO | GUEST </title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tooplate-artxibition.css') }}">
    <!--

Tooplate 2125 ArtXibition

https://www.tooplate.com/view/2125-artxibition

-->
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Pre HEader ***** -->


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">EVEN<em>TO</em></a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="{{ route('guest.index') }}"  class="active">Home</a></li>
                            <li><a href="{{ route('guest.event.index') }}"  >Shows & Events</a></li>
                            <li><a href="{{ route('mytickets') }}"> My Tickets</a></li>
                            <li><a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">logout</a>

                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->











    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-content">

                        <h6>Save the date for a unique and exciting experience!</h6>
                        <h2>Unforgettable moments await! Join us for an inspiring event</h2>
                        <div class="main-white-button">
                            <a href="tickets.html">Purchase Your Tickets</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- *** Owl Carousel Items ***-->
    <div class="show-events-carousel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- *** Owl Carousel Items ***-->
                    <div class="show-events-carousel">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="owl-show-events owl-carousel">
                                        <div class="item">
                                            <a href="event-details.html"><img
                                                    src="{{ asset('assets/images/show-events-01.jpg') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="item">
                                            <a href="event-details.html"><img
                                                    src="{{ asset('assets/images/show-events-02.jpg') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="item">
                                            <a href="event-details.html"><img
                                                    src="{{ asset('assets/images/show-events-03.jpg') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="item">
                                            <a href="event-details.html"><img
                                                    src="{{ asset('assets/images/show-events-04.jpg') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="item">
                                            <a href="event-details.html"><img
                                                    src="{{ asset('assets/images/show-events-01.jpg') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="item">
                                            <a href="event-details.html"><img
                                                    src="{{ asset('assets/images/show-events-02.jpg') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="item">
                                            <a href="event-details.html"><img
                                                    src="{{ asset('assets/images/show-events-03.jpg') }}"
                                                    alt=""></a>
                                        </div>
                                        <div class="item">
                                            <a href="event-details.html"><img
                                                    src="{{ asset('assets/images/show-events-04.jpg') }}"
                                                    alt=""></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- *** Venues & Tickets ***-->
    <div class="venue-tickets">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Our Venues & Tickets</h2>
                    </div>
                </div>
                @foreach ($verifiedEvents as $event)
                    <div class="col-lg-4">
                        <div class="venue-item">
                            <div class="thumb">
                                @if($event->getFirstMediaUrl('media/events'))
                                <img src="{{$event->getFirstMediaUrl('media/events')}}" alt="Event Image">
                               
                                @else
                                    <img src="{{ asset('assets/images/show-events-03.jpg') }}" alt="Default Image">
                                @endif
                          </div>
                            <div class="down-content">
                                <div class="left-content">
                                    <div class="main-white-button">
                                        <a href="{{ route('event.details', ['event' => $event->id]) }}">Purchase Tickets</a>
                                    </div>
                                </div>
                                <div class="right-content">
                                    <h4>{{ $event->title }}</h4>
                                    <p>{{ $event->lieu }}</p>
                                    <ul>
                                        <li><i class="fa fa-sitemap"></i>Available Tickets:
                                            {{ $event->available_tickets }}</li>
                                        <li><i class="fa fa-user"></i>Total Tickets: {{ $event->total_tickets }}</li>
                                    </ul>
                                    <div class="price">
                                        <span>1 ticket<br>from <em>${{ $event->ticket_price }}</em></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <!-- *** Coming Events ***-->
    <div class="coming-events">
        <div class="left-button">
            <div class="main-white-button">
                <a href="shows-events.html">Discover More</a>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($todaysEvents as $event)
                    <div class="col-lg-4">
                        <div class="event-item">
                            <div class="thumb">
                                <a href="{{ route('event.details', ['event' => $event->id]) }}">
                                    <img src="{{ $event->getFirstMediaUrl('media/events') ?: 'assets/images/show-events-03.jpg' }}" alt="Event Image">
                                </a>
                            </div>
                            <div class="down-content">
                                <a href="{{ route('event.details', ['event' => $event->id]) }}">
                                    <h4>{{ $event->title }}</h4>
                                </a>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i> {{ $event->date }} , at  {{ $event->hour }}</li>
                                    <li><i class="fa fa-map-marker"></i> {{ $event->lieu }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

















    <!-- *** Subscribe *** -->
    <div class="subscribe">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h4>Subscribe Our Newsletter:</h4>
                </div>
                <div class="col-lg-8">
                    <form id="subscribe" action="" method="get">
                        <div class="row">
                            <div class="col-lg-9">
                                <fieldset>
                                    <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*"
                                        placeholder="Your Email Address" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-3">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="main-dark-button">Submit</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- *** Footer *** -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="address">
                        <h4>localisation</h4>
                        <span>Boulevard moulay youssef, Youssoufia, Maroc</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="#">Info</a></li>
                            <li><a href="#">Venues</a></li>
                            <li><a href="#">Guides</a></li>
                            <li><a href="#">Videos</a></li>
                            <li><a href="#">Outreach</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="hours">
                        <h4>Open Support</h4>
                        <ul>

                            <li>ibtihalboukhanchouch@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="under-footer">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <p>Welcome to Evento</p>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <p class="copyright">Copyright 2024 EVENTO

                                    <br>Design: <a rel="nofollow" href="https://github.com/itzibtihal"
                                        target="_parent">itzibtihal</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="sub-footer">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="logo"><span>EVEN<em>TO</em></span></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="menu">
                                    <ul>
                                        <li><a href="index.html" class="active">Home</a></li>
                                        <li><a href="shows-events.html">Shows & Events</a></li>
                                        <li><a href="tickets.html">Tickets</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="social-links">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-2.1.0.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ asset('assets/js/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/imgfix.min.js') }}"></script>
    <script src="{{ asset('assets/js/mixitup.js') }}"></script>
    <script src="{{ asset('assets/js/accordions.js') }}"></script>
    <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>

    <!-- Global Init -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

</body>

</html>
